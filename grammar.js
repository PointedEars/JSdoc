// example grammar

var whitespace = new Literal('whitespace');
var optionalWhitespace = new Modifier(whitespace, '*');
var requiredWhitespace = new Modifier(whitespace, '+');

var type = new Production(
  'type',
  new Alternative(['Array', 'number', 'Object', 'string'])
)

var TypeExpression = new Production(
  'TypeExpression',
  new Group([
    type,
    new Modifier(new Group(['of', 'subtype']), '?'),
    new Modifier(new Group(['|', 'TypeExpression']), '?')
  ])
);

var number = new Production(
  'number',
  /[0-9]/
);

var subversion = new Production(
  'subversion',
  new Group([
    '.',
    new Modifier(number, '+'),
    new Modifier(subversion, '*')
  ])
);

var version = new Production(
  'version',
  new Group([
    new Modifier(number, '+'),
    new Modifier(subversion, '*')
  ])
);

var base_id = new Production(
  'base_id',
  null
);

var fragment_id = new Production(
  'fragment_id',
  null
);

var LinkResource = new Production(
  'LinkResource',
  new Group([
    new Modifier(base_id, '?'),
    '#',
    fragment_id,
    new Modifier('()', '*')
  ])
);

var ResourceExpression = new Production(
  'ResourceExpression',
  new Alternative([
    new Group([
      LinkResource,
      new Modifier(new Group([requiredWhitespace, version]), '*'),
      new Modifier(
        new Group([
          optionalWhitespace,
          ',',
          optionalWhitespace,
          ResourceExpression
        ]),
        '*')
    ]),
    new Group([
      '"',
      'resource',
      '"',
      new Modifier(
        new Group([
          optionalWhitespace,
          ',',
          optionalWhitespace,
          ResourceExpression
        ]),
        '*'
      )
    ]),
    new Group([
      "'",
      'resource',
      "'",
      new Modifier(
        new Group([
          optionalWhitespace,
          ',',
          optionalWhitespace,
          ResourceExpression
       ]),
       '*'
      )
    ])
  ])
);

var keyword = new Production(
  'keyword',
  new Alternative([
    new Group([
      '@',
      new Alternative([
        new Group([
          new Alternative(['author', 'section', 'subsection']),
          requiredWhitespace,
          'text'
        ]),
        new Group([
          'filename',
          new Modifier(whitespace, '+'),
          'filename'
        ]),
        new Group([
          'deprecated',
          new Modifier(new Group([requiredWhitespace, ResourceExpression]), '*')
        ]),
        new Group([
          new Alternative([
            'partof', 'dependson', 'reqfor', 'requiredfor', 'source'
          ]),
          new Group([requiredWhitespace, ResourceExpression])
        ])
      ])
    ]),
    new Group([
      new Alternative([
        'optional',
        new Group(['of', requiredWhitespace, 'subtype']),
        new Group(['default', requiredWhitespace, 'value'])
      ])
    ])
  ])
);

function jsDoc(o)
{
  if (o.elements && o.elements[0] && o.elements[0].value)
  {
    var s = o.elements[0].value; // source
    // find the first function
    var sFunctionHead =
        "(\\/\\*\\*([^*]|\\*[^\\/])*\\*\\/)*" // optional JSDoc before the head
      + "\\s*"                                // optional whitespace
      + "function"                            // function keyword
      + "(\\/\\*([^*]|\\*[^\\/])*\\/|\\s)+"   // comment or whitespace
      + "([A-Za-z_$UNICODE][_$\\wUNICODE]*)?" // function identifier
      + "\\s*"                                // optional whitespace
      + "\\(([^()]*(\\([^()]*\\)[^()]*)*)\\)" // declaration of arguments
      + "\\s*"                                // optional whitespace
      + "(\\/\\*([^*]|\\*[^\\/])*\\/|\\s)*"   // optional comment or whitespace
      + "\\s*"                                // optional whitespace
      + "\\{";                                // begin of body
      /*
       * paranthesized substring matches:
       * \1  optional JSDoc comment before the head
       * \2  optional JSDoc before the head
       * \3  comment or whitespace adjacent to the function keyword
       * \4  
       * \5
       * \6
       * \7
       */
    // Unicode support (from JavaScript 1.5 on)
    if ("\uFFFF".length == 1)
      sFunctionHead =
        sFunctionHead.replace(/UNICODE/g, "\\u0080-\\uFFFF");
    else
      sFunctionHead = sFunctionHead.replace(/UNICODE/g, "");

    var rxFunction = new RegExp(sFunctionHead); 

    var start = 0;
    var index;
    var accu = "";
    
    var x = rxFunction.exec(s);
    while (x != null)
    {
      accu += x[0] + "\n";
      x = rxFunction.exec(s);
    }
    alert(accu);
    // alert(accu.match(sFunctionHead).join("\n___\n"));
     
    //alert(sDoc);
    // return false;
     
    var sTitle = /<title>([^<]+)<\/title>/g.exec(s);
    if (sTitle)
      sTitle = sTitle[1];

    // alert(s.match(/\/\*.*\*\//g));

    var w = window.open();
    if (w
        && w.document
        && w.document.open
        && w.document.write
        && w.document.close)
    {
      w.document.open("text/html");
      w.document.write(
        '<DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"\n'
        + '"http://www.w3.org/TR/html4/loose.dtd">\n'
        + '<html>\n'
        + '  <he>\n'
        + '    <meta http-equiv="Content-Te"'
        + ' contenttext/html; charset=ISO-8859-1">\n'
        + '  <title>' + sTitle + '</title>\n'
        + '  </head>\n'
        + '  <body><pre>\n'
        + s.match(/\/\*.*?\*\//g).join("\n\n")
        + '  </pre><body>\n'
        + '</html>');
      w.document.close();
    }
    return false;
  }
}
