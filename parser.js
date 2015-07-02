/** @depends regexp.js */

/** @section Feature Objects */

/**
 * Constructs a newly allocated <code>Parser</code> object
 * using the text <code>s</code> and the token(s) <code>t</code>.
 * 
 * @param s: optional string
 *   Text to be parsed.
 * @param t: optional RegExp
 *   (Paranthesed) token patterns (use alternation).
 * 
 * @property text: string 
 *   Text to be parsed.
 * @property buffer: Array 
 *   Result buffer after applying <code>tokens</code> on
 *   <code>text</code>.
 * @property tokens: RegExp
 *   Regular Expression to specify parseable token patterns
 * @property index: number
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
  EOT:
  /**
   * @return type boolean
   *   <code>true</code> if no more tokens can be matched.
   */
  function parser_EOT()
  {
    return (this.tokens.lastIndex > this.text.length - 1);
  },

  read:
  /**
   * Reads the next token into the buffer and moves the start index.
   * 
   * @return type Object
   *   The new buffer.
   * @see jsref#RegExp.exec
   */
  function parser_read(iChars)
  {
  /*
    if (!this.EOT())
    {
  */
      this.buffer = this.tokens.exec(this.text);
      this.index = this.tokens.lastIndex;
  //}
  
    return this.buffer;
  },

  readEOLn: 
  /**
   * Reads into the buffer until End Of Line
   * and moves the start index.
   * 
   * @return type number
   *   The new start index.
   */
  function parser_readEOLn()
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

  readEOT: 
  /**
   * Reads into the buffer until End Of Text and moves
   * the start index.
   * 
   * @return type number
   *   The new start index, i.e. the length of the text.
   */
  function parser_readEOT()
  {
    if (!this.EOT())
    {
      this.buffer += this.text.substr(this.index);
      this.index = this.text.length;
    }
  
    return this.index;
  },

  clear: 
  /**
   * Clears the read buffer.
   * 
   * @return type string
   *   The buffer content (should be empty).
   */
  function parser_clear()
  {
    this.buffer = null;
  
    return !this.buffer;
  },
  
  reset: function parser_reset(t, s)
  {
    if (t)
    {
      this.tokens = t;
    }
    
    if (s)
    {
      this.text = s;
    }
    
    this.index = 0;
    this.tokens.lastIndex = 0;

    return this;
  }
}

/**
 * Base JSdoc parser prototype.
 * 
 * @param :string
 *   Source code to be parsed.
 * @param :string
 *   Name of the file where the source code originates
 *   to be assigned to the <code>filename</code> property.
 *   If omitted, "unnamed" is used.
 * @depends regexp.js
 */
function JSdocParser(s, sFileName)
{
  // TODO: Get rid of String literals once it is established that concatenating
  // RegExps is working smoothly everywhere where RegExp literals are supported.

  var rxTokens = regexp_concat(
    "(", // $1
     "(", // $2
      /(\/\*\*\s*(.+?)\s*\*\/)?\s*/, // $3, $4; ([^*]|\*[^\/])+ !match /*...**/
      
      /function\s*(\s+|\/\*\*?\s*(.+?)\*\/)\s*/, // $5, $6
      /([A-Za-z_$UNICODE][_$\wUNICODE]*)?/, // $10
      /\s*\(\s*([^()]*(\([^()]*\)[^()]*)*)\s*\)/,
        // declaration of arguments: $11, $12
        // TODO: JSdoc within arg. list
      /\s*((\/\*\*?\s*(.+?)\s*\*\/\s*)*)\s*/, // $13-$16
      /\{/,                                      // begin of function body
     ")",
    "|",
     /\/\*\*\s*(.+?)\s*\*\//, // $17, $18
    ")");

      /*
       * Paranthesized substring matches:
       * $[01]  all tokens (unused)
       * $2  section to contain a function declaration
       * $3  optional JSdoc comments directly before the function keyword
       * $4  comment (may be JSdoc) directly before the function keyword
       * $5  negative matches for context-sensitive parsing of comments (unused)
       * $7  comments (may be JSdoc) or (ignored) whitespaces directly after
       *     the function keyword
       * $8  optional comment directly after the function keyword (may be JSdoc)
       * $9  negative matches for context-sensitive parsing of comments (unused)
       * $10 optional function identifier
       * $11 optional arguments list
       * $12 optional argument (unused)
       * $13 optional comments (may be JSdoc) or (ignored) whitespaces after
       *     the arguments list
       * $14 optional comment (may be JSdoc) or (ignored) whitespace after
       *     the arguments list
       * $15 optional comment (may be JSdoc) after the arguments list
       * $16 negative matches for context-sensitive parsing of comments (unused)
       * $17 JSdoc comment not matching the first alternative
       * $18 negative matches for context-sensitive parsing of comments (unused)
       */
    var sTokens = regexp2str(rxTokens)
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

JSdocParser.prototype.reservedWords = [
  'abstract', 'boolean', 'break', 'byte', 'case', 'catch', 'char', 'class',
  'const', 'continue', 'debugger', 'default', 'delete', 'do', 'double', 'else',
  'enum', 'export', 'extends', 'false', 'final', 'finally', 'float', 'for',
  'function', 'goto', 'if', 'implements', 'import', 'in', 'instanceof', 'int',
  'interface', 'long', 'native', 'new', 'null', 'package', 'private',
  'protected', 'public', 'return', 'short', 'static', 'super', 'switch',
  'synchronized', 'this', 'throw', 'throws', 'transient', 'true', 'try',
  'typeof', 'var', 'void', 'volatile', 'while', 'with'
];

JSdocParser.prototype.getLastItem =
/**
 * Returns the last element of the {@link JSdocParser#items items} array.
 */
function jsdocParser_getLastItem()
{
  var i = this.items.length - 1;
  return this.items[((i < 0) ? 0 : i)];
}

JSdocParser.prototype.parse =
/**
 * Accumulate all JSdoc tokens in arrays.
 * 
 * @return type Array
 *   Parse buffer.
 */
function jsdocParser_parse()
{
  this.methods = new Array();

  var buf, c;
  while (this.read() && (buf = this.buffer)[1])
  {
    /*
       To avoid reference inconsistencies, at this point `this.buffer' should
       be added properties to identify the substring matches easily later:
       
       this.buffer.functionDeclarationSection = buf[2];
       this.buffer.globalJSdocComment = buf[17];

       aso.
     */
    
    // function declaration
    if (buf[2])
    {
      var m = new Method(buf);
      this.items.push(m);
      this.methods.push(m);
    }
    // other JSdoc comments
    else if ((c = buf[17]))
    {
      c = new JSdocComment(c);
      this.items.push(c);
    }
  }
}

JSdocParser.prototype.writeHTML =
/**
 * Creates a HTML documentation from the parsed JSdoc comments
 * 
 * @return type boolean
 *   <code>true</code> if successful, <code>false</code> otherwise.
 */
function jsdocParser_writeHTML()
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
      '    <meta name="generator" content="PointedEars\' JSdoc">',
      '    <meta http-equiv="Content-Type" content="text/html;'
        + ' charset=ISO-8859-1">',
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

function JSdocItem(s, t, p)
{
  this.items = [];
  if (p)
  {
    this.parser = p.reset(t, s);
  }
  else
  {
    this.parser = new JSdocParser(s);
  }
}

function Method(buf)
{
  /*
     How To Parse Methods:

     - Passes the following items to the constructor:
       * preceding JSdoc comment
       * method identifier
       * arguments list

     - Assign the `identifier' property

     - Parse the preceding JSdoc comment, add items
       to the collection properties of the Method
       object
     
     - Parse the arguments list
     
     - Determine the end of the function declaration
       and parse the function body up to that index.
     */
  JSdocItem.call(this);
  this.precedingComment = [buf[4], buf[7]].join("\n");
  this.identifier = buf[10] || "";
  this.args = buf[11];
  this.body = "";
  this.vars = [];
  this.consts = [];
  this.exceptions = [];
  this.see = [];
  this.isPrototype = false;
  this.isPrototypeMethod = false;
}

Method.prototype.toString = function method_toString()
{
  return this.identifier;
}

Method.prototype.parseBody = function()
{
  /*
   * PDA implementation to parse function body required
   * to distinct between in- and out-method comments
   */
  var
    // PDA alphabet, see below
    srxPDAgamma = [
      // ignore multi-line comments
      "/\\*.*?\\*/",
      // ignore single-line comments
      "|//[^\\n]*(\\n|$)",
      // ignore RegExp literals
      "|/(\\/|[^/])+/",  // TODO: Test this RegExp against real literals
      // ignore string literals,
      '|"([^"\\\\]|\\\\[UNICODE\\x00-\\xFF])*"',
      "|'([^'\\\\]|\\\\[UNICODE\\x00-\\xFF])*'",
      // don't ignore braces
      '|[{}]'].join("")
      .replace(/UNICODE/g, ("\uFFFF".length == 1) ? "\\u0100-\\uFFFF" : "");

  var
    depth = -1,
    match = null,
    rx = new RegExp(srxPDAgamma, 'g');

  rx.lastIndex = this.tokens.lastIndex;

  while (depth != 0 && (match = rx.exec(this.text)))
  {
    // no brace before
    if (depth != 0)
    {
      depth = 0;
    }
          
    switch (match[0])
    {
      case '{':
        depth++;
        break;

      case '}':
        depth--;
    }
  }

  // At this point, either the complete body has been parsed,
  // or EOF has been reached before the former was closed => syntax error
  return ((match && match.index) || -1);
}

function JSdocComment(s, parent)
{
  JSdocItem.call(
    this,
    s,
    new RegExp(
      ["@(",
        "version\\s+($VERSION)",
        "|author\\s+([^@]+)",
        "|section\\s+([^@]+)",
        "|subsection\\s+([^@]+)",
        "|filename\\s+($FILENAME)",
        "|deprecated\\s+($RESOURCE)",
       
       ")(\\s+|\\s*$)"]
       .join("")
       .replace(/\$RESOURCE/g, "$LINKRESOURCE(\s+$VERSION)*")
       .replace(
         /\$LINKRESOURCE/g,
         "(($BASE_ID#)?$FRAGMENT_ID)?$ARGUMENT_ID"
         + "|$BASE_ID#$FRAGMENT_ID$ARGUMENT_ID?")
       .replace(/\$BASE_ID/g, "$FILENAME")
       .replace(/\$VERSION/g, "\\d+(\\.\\d+)+")
       .replace(/\$FILENAME/g, "[^@]+(\\.[^@]+)*"),
      'g')); 
  
  this.parent = parent;
}
JSdocComment.prototype = new JSdocItem();

JSdocComment.prototype.parse = function jsdocComment_parse()
{
  var buf, tmp;
  if (this.parent)
  {
    while (this.read() && (buf = this.buffer)[1])
    {
      if (buf[2])
      {
        this.parent.version = buf[2];
      }
      else if (buf[3])
      {
        this.parent.author = buf[3];
      }
      else if (buf[4])
      {
        this.parent.items.push((tmp = new Section(buf[5])));
        this.parent.sections.push(tmp);
      }
      else if (buf[5])
      {
        this.parent.items.push((tmp = new Subsection(buf[6])));

        var s;
        if (this.parent.sections
            && (s =
              this.parent.sections[this.parent.sections.length-1].subsections))
        {
          s.push(tmp);
        }
      }
      else if (buf[6])
      {
        this.parent.filename = buf[6];
      }
      else if (buf[7] && this.parent.deprecated)
      {
        this.parent.deprecated.push(buf[7]);
      }
    }
  }
}

// document.write(getObjInfo(window, null, "stc"));
