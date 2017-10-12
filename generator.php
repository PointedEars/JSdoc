<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta name="generator" content="HTML Tidy, see www.w3.org">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>PointedEars' JavaScriptDoc&trade;: Documentation Generator</title>
    <!-- Dublic Core Metadata, see http://dublincore.org/ for details -->
    <meta name="DC.title" content="PointedEars' JavaScriptDoc&trade;">
    <meta name="DCTERMS.alternative" content="JSdoc&trade;">
    <meta name="DC.subject" content="Generator">
    <meta name="DC.creator" content="jsdoc@PointedEars.de (Thomas Lahn)">
    <meta name="DC.description" content=
    "An application that generates documentation markup from /** JSdoc&trade; comments */ within JavaScript&trade; source code. Includes syntax description with examples and the documentation generator.">
    <meta name="DC.publisher" content="jsdoc@PointedEars.de (Thomas Lahn)">
    <meta name="DCTERMS.issued" content="2004-12-13T03:57+0100">
    <meta name="DCTERMS.created" content="2004-12-13T03:57+0100">
    <meta name="DCTERMS.modified" content=
    "<?php $modi = date('Y-m-d\TH:i:sO', @filemtime(__FILE__)); echo $modi; ?>">
    <meta name="DCTERMS.available" content="2003-11-19T05:57:38+01:00">
    <meta name="DC.Type" content="InteractiveResource">
    <meta name="DC.Format" content="text/html">
    <meta name="DC.Identifier" content=
    "http://pointedears.de/scripts/JSdoc/generator">
    <meta name="DC.Language" content="en">
    <meta name="DC.Relation" content="http://pointedears.de/scripts/JSdoc/">
    <meta name="DC.Coverage" content="JavaScript">
    <meta name="DC.Rights" content=
    "Copyright � 2003, 2004. All rights reserved.">
    <meta name="DCTERMS.audience" content="JavaScript programmers">
    <meta name="DCTERMS.tableOfContents" content="Documentation Generator">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <style type="text/css">
      <!--
      body {
        margin-left:15px;
        margin-right:15px;
        background-color:white;
        color:black;
      }

      .jsdoc {
        background-color:#fff;
        color:#36c;
        text-decoration:inherit;
      }
      -->
    </style>
  </head>

  <body>
    <h1><a name="top" id="top">PointedEars' <span class=
    "jsdoc">JavaScriptDoc</span> (<span class=
    "jsdoc">JSdoc&trade;</span>)</a></h1>
    <ul>
      <li><a href="./#intro">Introduction</a>
        <ul>
          <li><a href="./#whatsthat">What
            <span class="jsdoc">JSdoc&trade;</span> is</a></li>

          <li><img src="../../media/ani-new.gif" width="width_in_pixels"
            height="height_in_pixels" border="0" alt="NEW!"><a
              href="./#whatsnot">What <span class="jsdoc">JSdoc&trade;</span>
              is not</a></li>
        </ul></li>

      <li><a href="#generator">Documentation Generator</a></li>

      <li><a href="./#syntax">Syntax</a></li>

      <li><a href="./#example">Example</a>
        <ul>
          <li><a href="./#example_input">Input</a></li>
          <li><a href="./#example_output">Output</a></li>
        </ul></li>

      <li><a href="./#grammar">Grammar</a></li>

      <li><a href="./#help">How you can help</a></li>

      <li><a href="./#copyright">Copyright &amp; disclaimer</a></li>

      <li><a href="./#online"><span class="jsdoc">JSdoc&trade;</span>
        online</a></li>
    </ul>

    <hr size="4">

    <h2><a name="generator" id="generator">Documentation Generator</a></h2>

    <script type="text/javascript">
      function getPriv()
      {
        try
        {
          netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
        }
        catch (e)
        {
          alert("Sorry, you can not enjoy this site because:\n\n" + e);
          return false;
        }

        return true;
      }

      function updateIFrame(oForm)
      {
        var e;
        if (oForm && (e = oForm.elements))
        {
          var o = e["doc"];
          if (o.files && o.files.length > 0)
          {
            var reader = new FileReader();
            reader.onloadend = function () {
              oForm.elements["src_text"].value = reader.result;
            };
            reader.readAsText(o.files[0]);
            return;
          }


          if (e["priv"].checked && getPriv())
          {
            try
            {
              frames['src'].location = 'file://' + o.value.replace(/\\/g, "/");
            }
            catch (e)
            {
              alert(e);
            }
          }
          else
          {
            frames['src'].location = o.value.replace(
                  new RegExp("^" + e["docroot"].value),
                  e["baseuri"].value);
          }
        }
      }
    </script>

    <form action="">
      <table>
        <tr>
          <td>Source <u>C</u>ode:</td>

          <td><input type="file" name="doc" accesskey="C"></td>
        </tr>

        <tr>
          <td>&nbsp;</td>

          <td><input type="checkbox" name="priv" id="priv" accesskey="P"
            onclick="var e = this.form.elements; e['docroot'].disabled = e['baseuri'].disabled = this.checked;"
            ><label for="priv">Request <u>p</u>rivileges to access local
            FS</label></td>
        </tr>

        <tr>
          <td>Document <u>R</u>oot:</td>

          <td><input name="docroot" value="<?php
              $docroot = $_SERVER['DOCUMENT_ROOT'];
              if (strpos($docroot, 'localhost') > -1)
              {
              	echo $docroot;
              }
              ?>" accesskey="R"> <input
              type="file" name="docroot_file"
              type="application/x-not-regular-file"
              value="<?php
                echo $_SERVER['DOCUMENT_ROOT'];
                ?>"
              accesskey="R"></td>
        </tr>

        <tr>
          <td><u>B</u>ase URI:</td>

          <td><input name="baseuri" accesskey="B" value="http://localhost/">
            <input type="button" name="apply" value="Apply" accesskey="A"
                   onclick="updateIFrame(this.form)"></td>
        </tr>
      </table>

      <iframe src="" name="src" cols="80" rows="20" style="width:100%"
        type="text/plain">Sorry, JSdoc requires IFRAME element support.</iframe>
      <textarea cols="80" rows="20" style="width:100%" accesskey="s"
        name="src_text">/**
 * @param {Array[number]} bar
 *   Optional input vector for Deep Thought.
 * @return {Earth}
 *   The computer that is able to provide The Question
 *   about Life, the Universe and Everything: Earth.
 * @throw EndOfTheUniverseException
 * @see "Adams, Douglas: The Restaurant at the End of the Universe"
 */
function universe_deepThought(foobar)
{
  alert(42);
  /** @property Earth */
  return (this.earth = new Earth());
}

/**
* @param {Array[number]} naturalConstants
*   The natural constants for the new universe.
* @throws InvalidArgumentException
* @see    Earth()
*/
function Universe (naturalConstants)
{
  if (naturalConstants in god.garbage)
  {
    throw new InvalidArgumentException();
  }
}
Universe.prototype.deepThought = universe_deepThought;

var ourUniverse = new Universe();</textarea>

       <script src="../object.js" type="text/javascript"></script>
       <script src="../types.js" type="text/javascript"></script>
       <script src="../test/debug.js" type="text/javascript"></script>
       <script src="../regexp.js" type="text/javascript"></script>
<!--
       <script src="../grammar.js" type="text/javascript"></script>
       <script src="grammar.js" type="text/javascript"></script>
-->
       <script src="parser.js" type="text/javascript"></script>
       <script src="jsdoc-simplest.js" type="text/javascript"></script>
       <script type="text/javascript">
         function parseMe(o)
         {
           // var parser = new JSdocParser(o.value);
           // parser.parse();
           // parser.writeHTML();
           var w = window.open("", "wGenerated", "width=" + screen.availWidth + ",height=" + screen.availHeight);
           if (!w) return;
           w.document.open("text/html");
           w.document.close();
           w.document.body.innerHTML = jsdoc.makeDoc(o.form.elements["src_text"].value);
         }

         function stripComments(o, iLevel)
         {
           var rxComments = (iLevel == 1)
             ? /("([^"\\]|\\")*"|'([^'\\]|\\')*')|\/\*\*([^*]|\*[^\/])*\*\//mg
             : /("([^"\\]|\\")*"|'([^'\\]|\\')*')|\/\*([^*]|\*[^\/])*\*\/|\/\/[^\r\n]*([\r\n]|$)/mg;

           var sReplacement = (iLevel == 1)
             ? '$1'
             : '$1$5';

           o.value = o.value.replace(rxComments, sReplacement);
         }
       </script>

       <input type="button" value="Generate Documentation" accesskey="g"
         onclick="parseMe(this.form.elements['src_text']);">
       <input type="button" value="Strip JSdoc"
         onclick="stripComments(this.form.elements['src_text'], 1);">
       <input type="button" value="Strip All Comments"
         onclick="stripComments(this.form.elements['src_text']);">
       <input type="reset" value="Reset Form">
    </form>

    <p><a href="#top">Go to top</a></p>

    <hr size="3">

    <h2><a name="copyright" id="copyright">Copyright &amp; Disclaimer</a></h2>

    <p>Copyright © 2003, 2004, 2017 Thomas Lahn &lt;<a
        href="mailto:JSdoc@PointedEars.de%20%28Thomas%20'PointedEars'%20Lahn%29"
        >jsdoc@PointedEars.de</a>&gt;.</p>

    <p><small>JavaScriptDoc, JSdoc and the JSdoc logos are trademarks of
      PointedEars&nbsp;Software (PES). <strong>All rights reserved.</strong><br>
      JavaScript and Javadoc are trademarks of Sun Microsystems Inc.<br>
      Other names and labels are the property of their respective
      owners.</small></p>

    <hr size="4">

    <p><b>Updated:</b> <?php echo $modi; ?></p> <p><a
      name="online" id="online">This document online</a>: &lt;<a
      href="http://pointedears.de/scripts/JSdoc/generator"
      >http://pointedears.de/scripts/jsdoc/generator</a>&gt;</p>

    <p><a href="#top">Go to top</a></p>
  </body>
</html>
