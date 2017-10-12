// jsx.define("JSX:jsdoc-simplest", "JSX:regexp", (function (jsdoc) {
  // return function () {

  if (!this.jsdoc) this.jsdoc = jsx.object.getDataObject();
  jsdoc.makeDoc = function (text) {
    var
      m = null,
      rx = new jsx.regexp.RegExp(
        "/\\*\\*(?<comment>(?:[^*/]|\\*[^/])+)\\*/"
        + "(\\s*function(?:\\s+(?<funcIdent>\\S+))?\\s*\\((?<funcParams>[^)]*)\\))?",
        "g"),
      data = Object.assign(Object.create(null), {
        functions: Object.create(null)
      });

    while ((m = rx.exec(s)))
    {
      /* DEBUG */
      console.log(m);

      var funcIdent = m.groups["funcIdent"];
      if (funcIdent)
      {
        var rxDocTag = new jsx.regexp.RegExp(
          "@(?<tag>\\S+)(?:\\s+\\{(?<type>.+?)\\})?(?:\\s+(?<name>\\S+))?"
          + "\\s+(?<description>(?:[^@*]|\\*[^/])*)",
          "g");
        var m2;

        m.groups["comment"] = m.groups["comment"].replace(/^\s*\*\s*/mg, "");

        while ((m2 = rxDocTag.exec(m.groups["comment"])))
        {
          /* DEBUG */
          console.log([
            m2.groups["tag"], m2.groups["type"], m2.groups["name"],
            m2.groups["description"]]);
        }

        data.functions[funcIdent] = {
          doc: m.groups["comment"],
          name: funcIdent,
          params: m.groups["funcParams"]
        };
      }
    }

    /* DEBUG */
    console.log(data);

    // commentContent = commentContent.replace(/^\s*\*/mg, "")
    //   .replace(/((?:\r?\n|\r)){2,}/g, '<p>');
    // html.push(`<p><code>${m[2]}</code></p>${commentContent}<hr>`);

    return html.join("");
  };
// };

// }(this.jsdoc || (this.jsdoc = {}))));
