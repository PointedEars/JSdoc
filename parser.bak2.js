/** @section Feature Objects */

/**
 * Parser prototype
 * 
 * @optional string s
 *   Text to be parsed.
 * @optional RegExp t
 *   (Paranthesed) token patterns (use alternation).
 * 
 * @property string text = s
 *   Text to be parsed
 * @property Array buffer = null
 *   Result buffer after applying @{tokens} on @{text}
 * @property RegExp tokens = t || null
 *   Regular Expression to specify parseable token patterns
 * @property number index
 *   Zero-based index of the next parsing position 
 */
function Parser(s, t)
{
  this.text    = s;
  this.buffer  = null;
  this.tokens  = t || null;
  this.index   = 0;
}

Parser.prototype = {
  /**
   * @return type boolean
   *   true, if no more tokens can be matched.
   */
  EOT: function parser_EOT()
  {
    return (this.tokens.lastIndex > this.text.length - 1);
  },

  /**
   * Reads @link{(iChars)} characters into
   * the buffer and moves the start index.
   * 
   * @argument number iChars
   *   Number of characters to read.
   * @return type number
   *   The new start index.
   */
  read: function parser_read(iChars)
  {
    this.buffer = this.tokens.exec(this.text);
    this.index = this.tokens.lastIndex;
  
    return this.buffer;
  },

  /**
   * Reads into the buffer until End Of Line
   * and moves the start index.
   * 
   * @return type number
   *   The new start index.
   */
  readEOLn: function parser_readEOLn()
  {
    if (!this.EOT())
    {
      var newText = this.text.substr(this.index);
      newText = newText.substr(0, newText.indexOf("\n"));
      this.buffer += newText;
      this.index = this.tokens.lastIndex + newText.length;    
    }
  
    return this.index;
  },

  /**
   * Reads into the buffer until End Of Text and moves
   * the start index.
   * 
   * @return type number
   *   The new start index, i.e. the length of the text.
   */
  readEOT: function parser_readEOT()
  {
    if (!this.EOT())
    {
      this.buffer += this.text.substr(this.index);
      this.index = this.text.length;
    }
  
    return this.index;
  },

  /**
   * Clears the read buffer.
   * 
   * @return type string
   *   The buffer content (should be empty).
   */
  clear: function parser_clear()
  {
    this.buffer = null;
  
    return !this.buffer;
  }
};

/**
 * Base JSdoc parser prototype.
 * 
 * @argument string _
 *   Source code to be parsed.
 * @argument string _
 *   Name of the file where the source code originates
 *   to be assigned @{filename} property.  If omitted,
 *   "unnamed" is used.
 */
function JSdocParser(s, sFileName)
{
  var sTokens = [
    "(", // $1
     "(", // $2
      "\\s*((\\/\\*\\s*(([^*]|\\*[^\\/])*)\\s*\\*\\/|\\s)*)\\s*", // $3-$6
      "function",                                 // function keyword
      "\\s*((\\/\\*\\s*(([^*]|\\*[^\\/])*)\\s*\\*\\/|\\s)+)\\s*", // $7-$10
      "([A-Za-z_$UNICODE][_$\\wUNICODE]*)?", // $11
      "\\s*",                                // optional whitespace
      "\\(\\s*((\\/\\*([^*]|\\*[^\\/])*\\*\\/|[^)])*)\\s*\\)",
        // declaration of arguments: $12, $13
      "\\s*((\\/\\*(([^*]|\\*[^\\/])*)\\*\\/|\\s)*)\\s*", // $14-$17
      "\\{",                                      // begin of function body
     ")",
    "|",
     "\\/\\*\\*(([^*]|\\*[^\\/])*)\\*\\/", // $18, $19
    ")"
    ]
      /*
       * Paranthesized substring matches:
       * $[01]  all tokens (unused)
       * $2  section to contain a function declaration
       * $3  comments (may be JSdoc) or (ignored) whitespaces directly before
       *     the function keyword
       * $4  comment (may be JSdoc) or (ignored) whitespace directly before
       *     the function keyword
       * $5  comment (may be JSdoc) directly before the function keyword
       * $6  negative matches for context-sensitive parsing of comments (unused)
       * $7  comments (may be JSdoc) or (ignored) whitespaces directly after
       *     the function keyword
       * $8  comment (may be JSdoc) or (ignored) whitespace directly after
       *     the function keyword
       * $9  optional comment directly after the function keyword (may be JSdoc)
       * $10 negative matches for context-sensitive parsing of comments (unused)
       * $11 optional function identifier
       * $12 optional arguments list
       * $13 optional argument (unused)
       * $14 optional comments (may be JSdoc) or (ignored) whitespaces after
       *     the arguments list
       * $15 optional comment (may be JSdoc) or (ignored) whitespace after
       *     the arguments list
       * $16 optional comment (may be JSdoc) after the arguments list
       * $17 negative matches for context-sensitive parsing of comments (unused)
       * $18 JSdoc comment not matching the first alternative
       * $19 negative matches for context-sensitive parsing of comments (unused)
       */
    .join("")
    // Unicode support (from JavaScript 1.5 on)
    .replace(/UNICODE/g, ("\uFFFF".length == 1) ? "\\u0080-\\uFFFF" : "");

  Parser.call(this, s, new RegExp(sTokens, "g"));
  this.filename = sFileName || "unnamed";
  this.items = [];
  this.globalVars = [];
  this.globalConsts = [];
  this.methods = [];
}
JSdocParser.prototype = new Parser();

JSdocParser.prototype.addProperties({
  reservedWords: [
    "abstract", "boolean", "break", "byte", "case", "catch", "char", "class",
    "const", "continue", "debugger", "default", "delete", "do", "double",
    "else", "enum", "export", "extends", "false", "final", "finally", "float",
    "for", "function", "goto", "if", "implements", "import", "in", "instanceof",
    "int", "interface", "long", "native", "new", "null", "package", "private",
    "protected", "public", "return", "short", "static", "super", "switch",
    "synchronized", "this", "throw", "throws", "transient", "true", "try",
    "typeof", "var", "void", "volatile", "while", "with"
  ],

  /**
   * Returns the last element of the @{#JSdocParser_items} array.
   */
  getLastItem: function jsdocParser_getLastItem()
  {
    var i = this.items.length - 1;
    return this.items[((i < 0) ? 0 : i)];
  },

  /**
   * Read the next JSdoc token into the buffer.
   *
   * @return type Array
   *   Parse buffer.
   */
  parse: function jsdocParser_parse()
  {
    var
      buf,
      bInMethod = false,
      p = new Parser();

    this.methods = new Array();

    while (this.read() && (buf = this.buffer)[1])
    {
      var sComment = buf[18];

      // function declaration
      if (buf[2])
      {
        /*
         * PDA implementation to parse function body required
         * to distinct between in- and out-method comments
         */
        var
          depth = 1,
          rx = new RegExp([
            // ignore multi-line comments
            "/*([^*]|\\*[^/])*\\*/",
              // ignore single-line comments
              "|//[^\\n]*(\\n|$)",
              // ignore RegExp literals
              "|/(\\/|[^/])*/",
              // ignore string literals,
              '|"([^"\\\\]|\\\\[UNICODE\\x00-\\xFF])*"',
              "|'([^'\\\\]|\\\\[UNICODE\\x00-\\xFF])*'",
              // don't ignore braces
              '|[{}]'].join(""),
            'g'),
          match,
          iStart = this.tokens.lastIndex + 1;

        rx = rx.replace(
          /UNICODE/g,
          ("\uFFFF".length == 1) ? "\\u0100-\\uFFFF" : "");

        rx.lastIndex = this.tokens.lastIndex;
/*
        while (depth > 0 || match.lastIndex > this.text.length)
        {
          match = rx.exec(this.text);
          switch (match[0])
          {
            case '{':
              depth++;
              break;

            case '}':
              depth--;
              break;
          }
        }
*/
        // Either the complete body has been parsed or EOF has been reached
        var m = new Method(buf[11], this.text.substring(iStart, rx.lastIndex));
        m.args = buf[12];

        this.items.push(m);
        this.methods.push(m);
      }
      // other JSdoc comments
      else if (sComment)
      {
        var c = new JSdocComment(sComment);
        if (bInMethod)
        {
          this.getLastItem().items.push(c);
        }
        else
        {
          this.items.push(c);
        }
      }
    }

    return this.methods.join("\n");
  },

  /**
   * Creates a HTML documentation from the parsed JSdoc comments
   *
   * @return type boolean
   *   <code>true</code> if successful, <code>false</code> otherwise.
   */
  writeHTML: function jsdocParser_writeHTML()
  {
    var
      w = window.open(),
      d = w && w.document;

    if (d && d.open && d.write && d.close)
    {
      var s = [
        '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN"',
        '  "http://www.w3.org/TR/html4/strict.dtd">',
        '<html>',
        '  <head>',
        '    <meta http-equiv="Content-Type" content="text/html;'
               + ' charset=ISO-8859-1">',
        '    <meta name="generator" content="PointedEars\' JSdoc">',
        '    <title>' + (this.title || this.filename) + '</title>',
        '  </head>\n',
        '  <body>\n',
      ].join("\n");

      for (var i = 0, len = this.methods.length; i < len; i++)
      {
        var m = this.methods[i], id = m.identifier;
        s += [
          '    <div><code><span class="ident"><a name="',
          id, '" id="', id, '">', id,
          '</a></span>(<var>', m.args, '</var>)</code></div>\n\n'
        ].join("");
      }

      s += [
        '  </body>',
        '</html>'
      ].join("\n");

      d.open();
      d.write(s);
      d.close();
      return true;
    }

    return false;
  }
});

function JSdocItem(s, t)
{
  this.items = [];
  this.parser = new Parser(s, t);
}

function Method(sIdent, sBody)
{
  JSdocItem.call(this, (this.body = sBody || ""), /.*/g);
  this.identifier = sIdent || "";
  this.vars = [];
  this.consts = [];
  this.exceptions = [];
  this.isPrototype = false;
  this.isPrototypeMethod = false;
}
Method.prototype = new JSdocItem();

Method.prototype.addProperties({
  toString: function method_toString()
  {
    return this.identifier;
  }
});

function JSdocComment(s)
{
  JSdocItem.call(this, s, /KEYWORDS/g);
}
JSdocComment.prototype = new JSdocItem();

// document.write(getObjInfo(window, null, "stc"));