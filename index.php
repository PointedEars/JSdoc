<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">

<html>
  <head>
    <meta name="generator" content="HTML Tidy, see www.w3.org">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

    <title>PointedEars' JavaScriptDoc&trade;</title>
    <!-- Dublic Core Metadata, see http://dublincore.org/ for details -->
    <meta name="DC.title" content="PointedEars' JavaScriptDoc&trade;">
    <meta name="DCTERMS.alternative" content="JSdoc&trade;">
    <meta name="DC.subject" content="Documentation">
    <meta name="DC.creator" content="jsdoc@PointedEars.de (Thomas Lahn)">
    <meta name="DC.description"
          content="An application that generates documentation markup from /** JSdoc&trade; comments */ within JavaScript&trade; source code. Includes syntax description with examples and the documentation generator."
          >
    <meta name="DC.publisher" content="jsdoc@PointedEars.de (Thomas Lahn)">
    <meta name="DCTERMS.issued" content="2003-11-19T05:57:38+01:00">
    <meta name="DCTERMS.created" content="2003-10-16T21:38:11+0200">
    <meta name="DCTERMS.modified"
          content="<?php
            $mdate = @filemtime(__FILE__);
            $modi = date('Y-m-d\TH:i:sO', $mdate);
            echo $modi;
            ?>">
    <meta name="DCTERMS.available" content="2003-11-19T05:57:38+01:00">
    <meta name="DC.Type" content="InteractiveResource">
    <meta name="DC.Format" content="text/html">
    <meta name="DC.Identifier" content="http://pointedears.de/scripts/JSdoc/">
    <meta name="DC.Source" content="JavaDoc&trade;, PHPdoc">
    <meta name="DC.Language" content="en">
    <meta name="DC.Relation" content="http://pointedears.de/scripts/">
    <meta name="DC.Coverage" content="JavaScript">
    <meta name="DC.Rights"
          content="Copyright &copy; 2003. All rights reserved.">
    <meta name="DCTERMS.audience" content="JavaScript programmers">
    <meta name="DCTERMS.tableOfContents"
          content="Syntax Description, Example, Documentation Generator">
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

      .jsdoc_key {
        background-color:#fff;
        color:#69c;
        font-weight:bold;
      }

      .jsdoc_entity, .jsdoc_tag {
        background-color:#fff;
        color:#669;
      }

      .jsdoc_link {
        background-color:#fff;
        color:#33c;
      }

      dt {
        margin-top:1em;
      }

      dd, p {
        text-align:justify;
      }
      -->
    </style>
  </head>

  <body>
    <h1><a name="top" id="top">PointedEars' <span class="jsdoc"
      >JavaScriptDoc</span> (<span class="jsdoc">JSdoc&trade;</span>)</a></h1>

    <ul>
      <li><a href="#intro">Introduction</a>
        <ul>
          <li><a href="#whatsthat">What <span class="jsdoc">JSdoc&trade;</span>
            is</a></li>

          <li><img src="../../media/ani-new.gif" width="width_in_pixels"
            height="height_in_pixels" border="0" alt="NEW!"> <a
            href="#whatsnot">What <span class="jsdoc">JSdoc&trade;</span>
            is not</a></li>
        </ul></li>

      <li><a href="generator">Documentation Generator</a></li>
      <li><a href="#syntax">Syntax</a></li>

      <li><a href="#example">Example</a>
        <ul>
          <li><a href="#example_input">Input</a></li>
          <li><a href="#example_output">Output</a></li>
        </ul>
      </li>

      <li><a href="#grammar">Grammar</a></li>
      <li><a href="#help">How you can help</a></li>
      <li><a href="#copyright">Copyright &amp; disclaimer</a></li>
      <li><a href="#online"><span class="jsdoc">JSdoc&trade;</span>
        online</a></li>
    </ul>
    <hr size="4">

    <h2><a name="intro" id="intro">Introduction</a></h2>

    <h3><a name="whatsthat" id="whatsthat">What <span class="jsdoc"
      >JSdoc&trade;</span> Is</a></h3>

    <p>This application generates documentation markup from <code
      class="jsdoc">/** JSdoc&trade; comments */</code> within JavaScript&trade;
      source code, and optionally generates source code from which those
      comments have been stripped.</p>

    <h3><a name="whatsnot" id="whatsnot">What <span class="jsdoc"
      >JSdoc&trade;</span> Is Not</a></h3>

    <p><strong><span class="jsdoc">JSdoc&trade;</span> is <em>not</em>
      <a href="http://jsdoc.sf.net/">JSDoc</a>!</strong>  PointedEars' (my)
      <span class="jsdoc">JSdoc&trade;</span> is a completely independent
      project that has been started 2003-10-16T21:38:11+0200 and is online
      since 2003-11-19T05:57:38+01:00. (Believe it or not: I did not know that
      there is JSDoc before 2004-01-23T02:03:11+01:00</em> as it was announced
      in <a href="news:de.comp.lang.javascript">de.comp.lang.javascript</a>,
      message-id &lt;<a href=
"http://groups.google.com/groups?as_umsgid=bukg0p$ivfbl$1@ID-27552.news.uni-berlin.de"
      >bukg0p$ivfbl$1@ID-27552.news.uni-berlin.de</a>&gt;.)</p>

    <p>Even though the names look similar, <span class="jsdoc"
      >JSdoc&trade;</span> and JSDoc differ in many ways:</p>

    <table border="1">
      <thead>
        <tr valign="top">
          <th align="left">Component/Feature</th>
          <th align="left">JSDoc</th>
          <th align="left"><span class="jsdoc">JSdoc&trade;</span></th>
        </tr>
      </thead>

      <tbody>
        <tr valign="top">
          <th align="left">Installation</th>
          <td>Must be installed to the local system</td>
          <td>Local installation is not required, it runs from any Web site
            that includes the required script libraries</td>
        </tr>

        <tr valign="top">
          <th align="left">Requirements</th>
          <td>Perl</td>
          <td>Web user agent (UA), ECMAScript 3 compliant script engine</td>
        </tr>

        <tr valign="top">
          <th align="left">Parser language</th>
          <td>Perl</td>
          <td>ECMAScript 3 compliant</td>
        </tr>

        <tr valign="top">
          <th align="left">Input</th>
          <td>Source code file</td>
          <td>Arbitrary source code string; retrieval via URI is possible</td>
        </tr>

        <tr valign="top">
          <th align="left" rowspan="6">Syntax</th>
          <td>Documentation comments are recognized only before each
              function declaration</td>
          <td>Context-sensitive parsing of documentation comments</td>
        </tr>

        <tr valign="top">
          <td><code>@argument</code> keyword as a synonym for the
              <code>@param</code> keyword</td>
          <td><code class="jsdoc">@argument</code> keyword as an extension to
            the <code class="jsdoc">@param</code> keyword to provide additional
            information about the requirement, the expected type and the default
            value of the argument</td>
        </tr>

        <tr valign="top">
          <td><code>@constructor</code> keyword is required to identify
              constructors</td>
          <td><code class="jsdoc">@constructor</code> keyword is only
              required if no prototype methods have been defined</td>
        </tr>

        <tr valign="top">
          <td><code>@return(s)</code> keywords to provide a description
              of the value returned from a function</td>
          <td><code class="jsdoc">@return(s)</code> keywords to provide
              both types and descriptions of possible values to be returned
              from a method</td>
        </tr>

        <tr valign="top">
          <td>-</td>
          <td>Distinction between instance and prototype properties</td>
        </tr>

        <tr valign="top">
          <td>-</td>
          <td>Conditional keywords to aide the generation of documentation
              for different environments from the same source code</td>
        </tr>

        <tr valign="top">
          <th align="left" rowspan="2">Output</th>
          <td>File containing HTML source code</td>
          <td>Valid XHTML 1.x or HTML 4.01 document, can be saved as file;
              with XHTML, XML applications like MathML and Ruby Annotation
              Markup are supported, display is supported depending on the
              used UA</td>
        </tr>

        <tr valign="top">
          <td>-</td>
          <td>Automagic syntax highlighting of contents within
              <code class="jsdoc_tag">code</code> elements</td>
        </tr>
      </tbody>
    </table>

    <p>Although not intended in the first place, I do hope the &trade;
      (trademark), the different spelling and coloring now helps to distinguish
      those two approaches of documentation for source code in languages based
      upon ECMAScript.</p>

    <p><a href="#top">Go to top</a></p>
    <hr size="3">

    <h2><a href="generator" name="generator" id="generator"
           >Documentation Generator</a></h2>

    <hr size="3">

    <h2><a name="syntax" id="syntax">Syntax</a></h2>

    <dl>
      <dt><code class="jsdoc"><span class="jsdoc_key">@title</span>
      <var>title</var><br>
      <span class="jsdoc_tag">&lt;title&gt;</span><var>title</var><span
      class="jsdoc_tag">&lt;/title&gt;</span></code></dt>

      <dd>Specifies the <var class="jsdoc">title</var> of the script&nbsp;file
        which will be used as document title and first-level heading.

        <p>Note: Subsequent occurrences of the <code
          class="jsdoc_key">@title</code> keyword or the <code
          class="jsdoc_tag">title</code> element will either be ignored or
          overwrite the previous definitions, depending on your settings (the
          latter is recommended, though, to avoid garbage content.)  You do not
          need to title functions, <span class="jsdoc">JSdoc&trade;</span> will
          title them automagically, using their identifier.</p></dd>

      <dt><code><span class="jsdoc">/** <span class="jsdoc_key">@version</span>
        <var class="jsdoc">version</var> */<br>
        /** <span class="jsdoc_key">@version</span> */</span>
        ..."<var>version</var>"...<br>
        <span class="jsdoc">/** <span class="jsdoc_key">@version</span>
        */</span> ...'<var>version</var>'...</code></dt>

      <dd>Specifies the <var class="jsdoc">version</var> of the script or the
        function.

        <p>This keyword may occur more than once within the same context. In
          that case, subsequent declarations overwrite previous ones.</p></dd>

      <dt><code class="jsdoc"><span class="jsdoc_key">@author</span>
        <var>authorship</var></code></dt>
      <dd>Specifies the <var class="jsdoc">authorship</var> of the script or the
        function. This may include, but is not limited to, copyright, name and
        e-mail address. It is good practice to use this template for <var
        class="jsdoc">authorship</var>:

        <p><code class="jsdoc">(C) <var>years</var>&nbsp;
          <var>full&nbsp;name</var> &lt;<var>email@address</var>&gt;</code></p>

        <p>(<span class="jsdoc">JSdoc&trade;</span> can automagically convert
          <code class="jsdoc">(C)</code> to &copy; [copyright], <code
          class="jsdoc">(TM)</code> or <code class="jsdoc">[TM]</code> to
          &trade; [trademark] and <code class="jsdoc">(R)</code> to &reg;
          [registered trademark].  Conversion can be done case-insensitive.)</p>

        <p>This keyword may occur more than once within the same context. In
          that case, authorship declarations are accumulated in a list.</p>
      </dd>

      <dt><var class="jsdoc"><a name="LinkResource" id="LinkResource"
        href="#LinkResource">LinkResource</a></var> ::=</dt>
      <dd>
        <code>[[<var class="jsdoc"><a href="#base_id">base_id</a></var> <span
          class="jsdoc_key">#</span>] <var class="jsdoc"><a
          href="#fragment_id">fragment_id</a></var>] <var class="jsdoc"><a
          href="#argument_id">argument_id</a></var><br>
          <var class="jsdoc"><a href="#base_id">base_id</a></var> [<span
          class="jsdoc_key">#</span> <var class="jsdoc"><a href="#fragment_id"
          >fragment_id</a></var> [<var class="jsdoc"><a href="#argument_id"
          >argument_id</a></var>]]</code>

        <p>Use <code><var class="jsdoc"><a href="#argument_id"
          >argument_id</a></var></code> to specify functions or function
          arguments.</p>
      </dd>

      <dt><var class="jsdoc"><a name="base_id" id="base_id"
        href="#base_id">base_id</a></var> ::=</dt>
      <dd><code><var class="jsdoc">filename</var><br>
        <var class="jsdoc">JSdocCatalogBaseID</var></code></dd>

      <dt><var class="jsdoc"><a name="fragment_id" id="fragment_id"
        href="#fragment_id">fragment_id</a></var> ::=</dt>
      <dd><code><var class="jsdoc">HTML401FragmentID</var> [lookahead not <span
        class="jsdoc_key">()</span>]</code></dd>

      <dt><var class="jsdoc"><a name="argument_id" id="argument_id"
        href="#argument_id">argument_id</a></var> ::=</dt>
      <dd><code><span class="jsdoc_key">(</span>[<var class="jsdoc"><a
        href="#word">word</a></var>]<span class="jsdoc_key">)</span></code></dd>

      <dt><var class="jsdoc"><a name="ResourceExpression"
        id="ResourceExpression" href="#ResourceExpression"
        >ResourceExpression</a></var> ::=</dt>
      <dd><code><var class="jsdoc"><a href="#LinkResource"
        >LinkResource</a></var> [<var class="jsdoc">version</var>] [<span
        class="jsdoc_key">,</span> <a href="#ResourceExpression"
        >ResourceExpression</a>]<br>
        <span class="jsdoc">"<var>resource</var>"</span> [<span
        class="jsdoc_key">,</span> <a href="#ResourceExpression"
        >ResourceExpression</a>]<br>
        <span class="jsdoc">'<var>resource</var>'</span> [<span
        class="jsdoc_key">,</span> <a href="#ResourceExpression"
        >ResourceExpression</a>]</code>

        <p>Specifies a <var class="jsdoc">resource</var>.  Use quotes to prevent
          <span class="jsdoc">JSdoc&trade;</span> from looking up substrings for
          hyperlink creation.</p>
      </dd>

      <dt><code><span class="jsdoc"><span class="jsdoc_key"
        >@</span></span>[<span class="jsdoc_key">link</span>]<span
        class="jsdoc_key">{</span><var class="jsdoc"><a href="#LinkResource"
        >LinkResource</a></var>[<span class="jsdoc_key">,</span>
        <var class="jsdoc">description</var>]<span class="jsdoc_key"
        >}</span></code></dt>

      <dd>Specifies a visible hyperlink to a resource. Probably the most
        important keyword. Use <var class="jsdoc">description</var> to
        specify the text to be displayed instead of the formatted <code><var
        class="jsdoc"><a href="#LinkResource"
        >LinkResource</a></var></code>.</dd>

      <dt><code><span class="jsdoc"><span class="jsdoc_key"
        >@deprecated</span></span> [<var><a href="#ResourceExpression"
        >ResourceExpression</a></var>]</code></dt>
      <dd>Specifies a resource that is no longer required by
        the script or function (due to refactoring).<br>
        Marks the current context as deprecated if <var
        class="jsdoc">ResourceExpression</var> is omitted.</dd>

      <dt><code><span class="jsdoc"><span class="jsdoc_key">@filename</span>
        <var class="jsdoc">filename</var></span></code></dt>
      <dd>Specifies the original <var class="jsdoc">filename</var> of the
        script file.</dd>

      <dt><code class="jsdoc"><span class="jsdoc_key">@partof</span> <var><a
        href="#ResourceExpression">ResourceExpression</a></var></code></dt>
      <dd>Specifies a resource that the script&nbsp;file is part of.</dd>

      <dt><code class="jsdoc"><span class="jsdoc_key">@requires</span>
        <var><a href="#ResourceExpression"
        >ResourceExpression</a></var></code></dt>
      <dd>Specifies a resource that is required by the script or function.</dd>

      <dt><code class="jsdoc"><span class="jsdoc_key">@requiredby</span>
        <var><a href="#ResourceExpression"
        >ResourceExpression</a></var></code></dt>
      <dd>Specifies a resource that the script file or function is required
          for.</dd>

      <dt><code class="jsdoc"><span class="jsdoc_key">@source</span> <var><a
        href="#ResourceExpression">ResourceExpression</a></var></code></dt>
      <dd>Specifies a resource the script file or the function is based
        upon.</dd>

      <dt><code class="jsdoc"><span class="jsdoc_key">@section</span>
        <var>title</var></code></dt>
      <dd>Specifies the beginning of a new section titled <var class=
          "jsdoc">title</var>, also to be used as second-level heading.</dd>

      <dt><code class="jsdoc"><span class="jsdoc_key">@subsection</span>
        <var>title</var></code></dt>
      <dd>Specifies the beginning of a new subsection titled <var class=
          "jsdoc">title</var>, also to be used as third-level heading.</dd>

      <dt><var class="jsdoc"><a name="TypeExpression" id="TypeExpression"
        href="#TypeExpression">TypeExpression</a></var> ::=</dt>
      <dd>
        <code><span class="jsdoc"><var>type</var></span> [<span class="jsdoc"
          ><span class="jsdoc_key">of</span>&nbsp;<var>subtype</var></span>]
          [<span class="jsdoc_key">|</span> <a href="#TypeExpression"
          >TypeExpression</a>]</code>

        <p>Specifies the <var class="jsdoc">type</var>(s) of data that is
          stored/referenced to, and if provided, the <var class="jsdoc"
          >subtype</var>(s) of it. If <var class="jsdoc">type</var> is an
          object type (i.e. <code class="ident">Object</code> or <code
          class="ident">Array</code>), and if each each element/property of the
          object is intended to be of the same <var class="jsdoc">subtype</var>,
          you should also use the <code class="jsdoc_key">of</code> keyword to
          specify that <var class="jsdoc">subtype</var>; if not, you should omit
          the <code class="jsdoc_key">of</code> keyword and describe the data
          further with the <var class="jsdoc">description</var> parameter of
          the <code class="jsdoc_key">@argument</code> keyword or the
          <code class="jsdoc_key">@param</code> keyword.</p>
      </dd>

      <dt><code><span class="jsdoc">/** <span class="jsdoc_key">@type</span>
        <var class="jsdoc"><a href="#TypeExpression">TypeExpression</a></var>
        */</span> [<span class="rswd">var</span>] <var>identifier</var> [<span
        class="punct">=</span> <var>value</var>][<span class="punct"
        >;</span>]</code></dt>
      <dd>Specifies the <var class="jsdoc">type</var> of data/object the
        <code><var>identifier</var></code> variable stores/references to.
        Omit the keyword if the variable stores/references values/objects
        of different types.</dd>

      <dt><code><span class="jsdoc">/** <span class="jsdoc_key"
        >@arguments</span></span> [<var class="jsdoc"><a href="#TypeExpression"
        >TypeExpression</a></var>] <span class="jsdoc">*/</span> <span
        class="rswd">function</span> <var>identifier</var><span class="punct"
        >(</span><span class="punct">)</span></code></dt>
      <dd>Specifies that the <code><var>identifier</var><span class="punct"
        >(</span><var>...</var><span class="punct">)</span></code> function
        accepts an unlimited number of arguments. If those arguments must be of
        the same type (and subtype), you should provide it.</dd>

      <dt><code class="jsdoc">/** <span class="jsdoc_key">@argument</span>
        <var>...</var> */</code></dt>
      <dd>Same as <code class="jsdoc"><span class="jsdoc_key">@param</span>
        <var>...</var></code>.</dd>

      <dt><code class="jsdoc">/** <span class="jsdoc_key">@optional</span>
        <var>...</var> */</code></dt>
      <dd>Same as <code class="jsdoc"><span class="jsdoc_key">@param</span>
        [<var>identifier</var>] : <span class="jsdoc_key"
        >optional</span> <var>...</var></code>.</dd>

      <dt><code><span class="jsdoc">/** <span class="jsdoc_key">@param</span>
        [<var>identifier</var>] [: [<span class="jsdoc_key"
        >optional</span>] <var><a href="#TypeExpression"
        >TypeExpression</a></var>] [(<span class="jsdoc_key"
        >default</span>|<span class="jsdoc_key">=</span>)&nbsp;<var>value</var>]
        [<var>description</var>] */</span></code></dt>
      <dd>Specifies the <var class="jsdoc">identifier</var> argument of a
        function. If <var class="jsdoc">identifier</var> is omitted or
        &quot;<code class="jsdoc">_</code>&quot;, the documentation of
        <var class="jsdoc">identifier</var> is assigned in order of
        declaration.<br>
        
        <p>Use the <code class="jsdoc_key">optional</code> keyword to specify
          that the argument is optional, i.e. the function works even if it is
          not provided (as there is no arity in JavaScript.) If so, you should
          also use the <code class="jsdoc_key">default</code> or the <code
          class="jsdoc_key">=</code> keyword to specify the default <var
          class="jsdoc">value</var>.</p></dd>

      <dt><code><span class="jsdoc">/** <span class="jsdoc_key">@property</span>
        <var class="jsdoc"><a href="#TypeExpression">TypeExpression</a></var>
        */</span> <var>object</var><span class="punct">.</span><var
        >identifier</var>
        [<span class="punct">=</span> <var>value</var>][<span class="punct"
        >;</span>]</code><br>
        <code><span class="jsdoc">/** <span class="jsdoc_key">@property</span>
        <var class="jsdoc"><a href="#TypeExpression">TypeExpression</a></var>
        */</span> <var>object</var><span class="punct">[</span>"<var
        >identifier</var>"<span class="punct">]</span> [<span class="punct"
        >=</span> <var>value</var>][<span class="punct">;</span>]</code><br>
        <code><span class="jsdoc">/** <span class="jsdoc_key">@property</span>
        <var class="jsdoc"><a href="#TypeExpression">TypeExpression</a></var>
        */</span> <var>object</var><span class="punct">[</span>'<var
        >identifier</var>'<span class="punct">]</span> [<span class="punct"
        >=</span> <var>value</var>][<span class="punct">;</span>]</code></dt>
      <dd>Specifies that <var>identifier</var> is a property of
        <var>object</var>. Although <span class="jsdoc">JSdoc&trade;</span>
        attempts to detect what properties an object has, it cannot detect the
        <var class="jsdoc">type</var> of data these properties should
        accept.</dd>

      <dt><code><span class="jsdoc">/** <span class="jsdoc_key">@method</span>
        [<var class="jsdoc"><a href="#TypeExpression">TypeExpression</a></var>]
        */</span> <var>object</var><span class="punct">.</span><var
        >identifier</var> [<span class="punct">=</span> <var>value</var>][<span
        class="punct">;</span>]</code><br>
        <code><span class="jsdoc">/** <span class="jsdoc_key">@method</span>
        [<var class="jsdoc"><a href="#TypeExpression">TypeExpression</a></var>]
        */</span> <var>object</var><span class="punct">[</span>"<var
        >identifier</var>"<span class="punct">]</span> [<span class="punct"
        >=</span> <var>value</var>][<span class="punct">;</span>]</code><br>
        <code><span class="jsdoc">/** <span class="jsdoc_key">@method</span>
        [<var class="jsdoc"><a href="#TypeExpression">TypeExpression</a></var>]
        */</span> <var>object</var><span class="punct">[</span>'<var
        >identifier</var>'<span class="punct">]</span> [<span class="punct"
        >=</span> <var>value</var>][<span class="punct">;</span>]</code></dt>
      <dd>Specifies that <var>identifier</var> is a method of <var>object</var>,
        i.e. a property of type <code class="rswd">function</code>.  If the
        method is defined with the <code class="ident">Function</code>
        constructor or the <code class="rswd">function</code> operator, you
        should specify the <var class="jsdoc">type</var> and, if necessary, the
        <var class="jsdoc">subtype</var> of the value the method returns.
        Otherwise, i.e. if you assign a reference to a <code class="ident"
        >Function</code> object using its identifier, <span class="jsdoc"
        >JSdoc&trade;</span> attempts to determine the type using the data that
        has been specified for that function with the <code class="jsdoc_key"
        >@type</code> keyword.</dd>

      <dt><code><span class="jsdoc">/** <span class="jsdoc_key"
        >@return</span></span>[<span class="jsdoc_key">s</span>] [<span
        class="jsdoc_key">type</span>&nbsp;<var class="jsdoc"><a
        href="#TypeExpression">TypeExpression</a></var>] [<var class="jsdoc"
        >description</var>] <span class="jsdoc">*/</span> <span class="rswd"
        >function</span> <var>identifier</var><span class="punct"
        >(</span><var>...</var><span class="punct">)</span></code></dt>
      <dd>Specifies a description and/or the type(s) of the value(s) the
        <code><var>identifier</var><span class="punct">(</span><var
        >...</var><span class="punct">)</span></code> function can return.  Use
        the <code class="jsdoc_key">type</code> keyword to specify the type(s)
        of the value(s) returned.  If it returns more than one value of a type,
        place both descriptions directly after the keyword for this <var
        class="jsdoc"><a href="#TypeExpression">TypeExpression</a></var>.
        <code class="jsdoc_key">@return</code> and <code class="jsdoc_key"
        >@returns</code> are equally supported, the former for compatibility
        reasons.</dd>

      <dt><code class="jsdoc">/** <span class="jsdoc_key">@throws</span>
        <var>identifier</var> */</code></dt>
      <dd>Specifies the exception(s) a function throws.</dd>

      <dt><code><span class="jsdoc">/** <span class="jsdoc_key">@see</span>
        <var><a href="#ResourceExpression">ResourceExpression</a></var></span>
        <span class="jsdoc">*/</span></code></dt>
      <dd>Specifies crossreferences to other documentation.</dd>
    </dl>

    <p><span class="jsdoc">JSdoc&trade;</span> blocks are combined where each
      block is interpreted as a paragraph unless they are not separated by
     JavaScript code containing a definition or declaration or started with a
     <code class="jsdoc_key">@keyword</code>. The parameters for a <code
     class="jsdoc_key">@keyword</code> are considered finished when the
     generator finds another keyword or the current <span class="jsdoc"
     >JSdoc&trade;</span> block ends. Empty lines are considered the delimiter
     between paragraphs. Leading asterisks are ignored by default (see
     below.)</p>

    <p><a href="#top">Go to top</a></p>
    <hr size="3">

    <h2><a name="example" id="example">Example</a></h2>

    <h3><a name="example_input" id="example_input">Input</a></h3>

    <p><code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|<br>

      <span class="jsdoc">/**<br>
      &nbsp;* <span class="jsdoc_key">@optional</span> foobar<span
      class="jsdoc_key">:</span>Array <span
      class="jsdoc_key">of</span> number<br>
      &nbsp;* &nbsp;&nbsp;Optional input vector for Deep Thought.<br>
      &nbsp;* <span class="jsdoc_key">@property</span> earth<span
      class="jsdoc_key">:</span>Earth<br>
      &nbsp;* <span class="jsdoc_key">@return type</span> Earth<br>
      &nbsp;* &nbsp;&nbsp;The computer that is able to provide The Question<br>
      &nbsp;* &nbsp;&nbsp;about Life, the Universe and Everything -- Earth.<br>
      &nbsp;* <span class="jsdoc_key">@throws</span><br>
      &nbsp;* &nbsp;&nbsp;EndOfTheUniverseException<br>
      &nbsp;* <span class="jsdoc_key">@see</span><br>
      &nbsp;* &nbsp;&nbsp;"Adams, Douglas: The Restaurant at the End of the
      Universe"<br>
      &nbsp;*/</span><br>
      <span class="rswd">function</span> universe_deepThought<span
      class="punct">(</span>foobar<span class="punct">)</span><br>
      <span class="punct">{</span><br>
      &nbsp;&nbsp;<span class="ident">alert</span><span class="punct"
      >(</span><span class="num">42</span><span class="punct">);</span><br>
      &nbsp;&nbsp;<span class="rswd">return</span> <span class="punct"
      >(</span><span class="rswd">this</span><span class="punct"
      >.</span>earth <span class="punct">=</span> <span class="rswd"
      >new</span> <span class="ident">Earth</span><span class="punct"
      >());</span><br>
      <span class="punct">}</span><br>
      <br>
      <span class="jsdoc">/**<br>
      &nbsp;* <span class="jsdoc_key">@optional</span> naturalConstants<span
      class="jsdoc_key">:[</span>number<span class="jsdoc_key">]</span><br>
      &nbsp;* &nbsp;&nbsp;The natural constants for the new universe.<br>
      &nbsp;* <span class="jsdoc_key">@method prototype</span> deepThought<br>
      &nbsp;* <span class="jsdoc_key">@throws</span><br>
      &nbsp;* &nbsp;&nbsp;InvalidArgumentException<br>
      &nbsp;* <span class="jsdoc_key">@see</span><br>
      &nbsp;* &nbsp;&nbsp;Earth()<br>
      &nbsp;*/</span><br>
      <span class="rswd">function</span> Universe<span class="punct"
      >(</span>naturalConstants<span class="punct">)</span><br>
      <span class="punct">{</span><br>
      &nbsp;&nbsp;<span class="rswd">if</span> <span class="punct"
      >(</span>naturalConstants <span class="rswd">in</span> god.garbage<span
      class="punct">)</span><br>
      &nbsp;&nbsp;<span class="punct">{</span><br>
      &nbsp;&nbsp;&nbsp;&nbsp;<span class="rswd">throw new</span> <span
      class="ident">InvalidArgumentException</span><span class="punct"
      >();</span><br>
      &nbsp;&nbsp;<span class="punct">}</span><br>
      <span class="punct">}</span><br>
      Universe<span class="punct">.</span>prototype<span class="punct"
      >.</span>deepThought <span class="punct">=</span> <span class="ident"
      >universe_deepThought</span><span class="punct">;</span><br>
      <br>
      <span class="rswd">var</span> ourUniverse = <span class="rswd">new</span>
      <span class="ident">Universe</span><span class="punct"
      >();</span></code></p>

    <h3><a name="example_output" id="example_output">Output</a></h3>

    <p>The following is a <em>possible</em> documentation to be created by
      <span class="jsdoc">JSdoc&trade;</span> from the above source code,
      using only a minimum stylesheet. You can define your own settings and
      stylesheets to make the content and layout fitting to your needs.</p>

    <hr size="2">

    <p><code><span class="ident"><a name="universe_deepThought"
      id="universe_deepThought">universe_deepThought</a></span>([<var>foobar
      : <span
      class="ident"><a
      href="http://web.archive.org/devedge.netscape.com/manuals/2000/javascript/1.5/reference/array.html"
      >Array</a></span>[<a
      href="http://web.archive.org/devedge.netscape.com/manuals/2000/javascript/1.5/reference/number.html"
      >number</a>]</var>])
      : <span class="ident"><a href="#Earth">Earth</a></span></code></p>

    <table>
      <tr valign="top">
        <th align="left">Arguments:</th>
        <td><dl>
            <dt><var>foobar : <span
      class="ident"><a
      href="http://web.archive.org/devedge.netscape.com/manuals/2000/javascript/1.5/reference/array.html"
      >Array</a></span>[<a
      href="http://web.archive.org/devedge.netscape.com/manuals/2000/javascript/1.5/reference/number.html"
      >number</a>]</var></dt>
            <dd>Optional input vector for Deep Thought.</dd>
          </dl></td>
      </tr>

      <tr valign="top">
        <th align="left">Properties:</th>
        <td><dl>
            <dt><code><var>earth</var>
            : <span class="ident"><a href="#Earth">Earth</a></span></code></dt>
          </dl></td>
      </tr>

      <tr valign="top">
        <th align="left">Return value:</th>
        <td>The computer that is able to provide The Question about Life, the
          Universe and Everything -- Earth.</td>
      </tr>

      <tr valign="top">
        <th align="left">Throws:</th>
        <td><code><a href="#EndOfTheUniverseException"
          >EndOfTheUniverseException</a></code></td>
      </tr>

      <tr valign="top">
        <th align="left" nowrap>See also:</th>
        <td>Adams, Douglas: The Restaurant at the End of the Universe</td>
      </tr>
    </table>

    <hr size="1">

    <p><code><span class="ident"><a name="Universe" id="Universe"
      >Universe</a></span>([<var>naturalConstants : <span class="ident"><a
      href="http://web.archive.org/devedge.netscape.com/manuals/2000/javascript/1.5/reference/array.html"
      >Array</a></span>[<a
      href="http://web.archive.org/devedge.netscape.com/manuals/2000/javascript/1.5/reference/number.html"
      >number</a>]</var>])</code></p>

    <table>
      <tr valign="top">
        <th align="left">Arguments:</th>
        <td>
          <dl>
            <dt><var>naturalConstants : <span class="ident"><a
      href="http://web.archive.org/devedge.netscape.com/manuals/2000/javascript/1.5/reference/array.html"
      >Array</a></span>[<a
      href="http://web.archive.org/devedge.netscape.com/manuals/2000/javascript/1.5/reference/number.html"
      >number</a>]</var></dt>
            <dd>The natural constants for the new universe.</dd>
          </dl>
        </td>
      </tr>

      <tr valign="top">
        <th align="left">Properties:</th>
        <td>
          <dl>
            <dt><code><var>earth</var>
            : <span class="ident"><a href="#Earth">Earth</a></span></code></dt>
          </dl>
        </td>
      </tr>

      <tr valign="top">
        <th align="left">Prototype methods:</th>
        <td>
          <dl>
            <dt><code><a href="#universe_deepThought"
              >deepThought</a>() : <span class="ident"
              ><a href="#Earth">Earth</a></span></code></dt>
          </dl>
        </td>
      </tr>

      <tr valign="top">
        <th align="left">Throws:</th>
        <td><code><a href="#InvalidArgumentException"
          >InvalidArgumentException</a></code></td>
      </tr>

      <tr valign="top">
        <th align="left" nowrap>See also:</th>
        <td><code><a href="#Earth">Earth</a>()</code></td>
      </tr>
    </table>

    <p><a href="#top">Go to top</a></p>
    <!-- Documentation Generator -->
    <hr size="3">

    <h2><a name="grammar" id="grammar">Grammar (incomplete)</a></h2>
      Shorthand notation:

    <ul>
      <li><code><b>*</b></code>: 0 or more, greedy</li>
      <li><code><b>*?</b></code>: 0 or more, non-greedy</li>
      <li><code><b>+</b></code>: 1 or more, greedy</li>
      <li><code><b>+?</b></code>: 1 or more, non-greedy</li>
      <li><code><b>?</b></code>: 0 or 1, greedy</li>
      <li><code><b>??</b></code>: 0 or 1, non-greedy</li>
      <li><code><b>|</b></code>: separates alternatives</li>
      <li><code><b>[ ]</b></code>: grouping</li>
    </ul>
<pre>

JSdoc
  : <a href="#JSdoc_comment">JSdoc_comment</a> [<a href="#whitespace">whitespace</a>* JSdoc_comment]*
  | JSdoc_comment [<b>lookahead</b> [not JSdoc_comment] [ ';' | <a href="#newline">newline</a> ]]

<a name="JSdoc_comment" id="JSdoc_comment">JSdoc_comment</a>
  : <a href="#comment_start">comment_start</a> whitespace* <a href="#comment">comment</a>+ whitespace* <a href="#comment_end">comment_end</a>

<a name="comment_start" id="comment_start">comment_start</a>
  : '/**'

<a name="comment" id="comment">comment</a>
  : [<a href="#keyword">keyword</a> whitespace+]? keyword [whitespace+ <a href="#argument" style="color:red">argument</a>]* [whitespace+ comment]?
  | <a href="#element">element</a>+ [whitespace+ comment]?

<a name="keyword" id="keyword">keyword</a>
  : @[<a href="#argument">argument</a>
      | 'version' VersionExpression
      | ['author' | 'section' | 'subsection'] whitespace+ text
      | 'filename' whitespace+ filename
      | 'deprecated' [whitespace+ ResourceExpression]*
      | ['partof' | 'dependson' | 'reqfor' | 'requiredfor' | 'source']
        whitespace+ ResourceExpression
      | ['link']? '{' LinkResource '}'
     ]

<a name="argument" id="argument">argument</a>
  : [['argument' | 'param'] [text+ whitespace+]?
     [whitespace* ':' whitespace* [whitespace+ 'optional']? whitespace* TypeExpression]
     | 'optional' [text+ whitespace+]?
       [whitespace* ':' whitespace* TypeExpression]]
    [[whitespace+ ['default' whitespace+ | '='] whitespace+] ECMAScriptValue]

VersionExpression
  : whitespace+ version
  | whitespace*
    [<b>lookahead</b> comment_end text*? string_delimiter text+? string_delimiter]

version
  : number+ subversion*

subversion
  : '.' number+ subversion*

string_delimiter
  : [lookahead not '\'] '"'
  | [lookahead not '\'] "'"

filename
  : text+ ['.' text]*

ResourceExpression
  : [LinkResource [whitespace+ version]*
     | string_delimiter text+ string_delimiter
    ]
    [whitespace* ',' whitespace* ResourceExpression]*

LinkResource
  : [[base_id '#']? fragment_id]? argument_id
  | base_id '#' fragment_id argument_id?

base_id
  : filename
  | JSdocCatalogBaseID

fragment_id
  : HTML401FragmentID [lookahead not '()']

argument_id
  : '(' text*  ')'

TypeExpression
  : type whitespace+ ['of' whitespace+ subtype]? whitespace* ['|' whitespace* TypeExpression]?
  | '[' whitespace* [subtype] whitespace* ']' ['|' whitespace* TypeExpression]?   
  | '{' whitespace* [subtype] whitespace* '}' ['|' whitespace* TypeExpression]?

<a name="element" id="element">element</a>
  : <a href="#text">text</a>+
  | '&lt;' <a href="#tagname">tagname</a> '&gt;' whitespace* [element whitespace* '&lt;/' tagname '&gt;']*
  | '&lt;' tagname '/&gt;'

<a name="text" id="text">text</a>
  : <a href="#ASCII" style="color:red">ASCII</a> | <a href="#ISO9959" style="color:red">ISO8859</a> | <a href="#UNICODE" style="color:red">UNICODE</a>
  | <a href="#HTML401entity" style="color:red">HTML401entity</a> | <a href="#HTML401Lat1Entity" style="color:red">HTML401Lat1Entity</a>

<a name="tagname" id="tagname">tagname</a>
  : <a href="#HTML401Element" style="color:red">HTML401Element</a>
  | <a href="#XHTML10Element" style="color:red">XHTML10Element</a>

<a name="word" id="word">word</a>
  : ['a'-'z','A'-'Z','_',UNICODE] text

<a name="comment_end" id="comment_end">comment_end</a>
  : '*/'

<a name="whitespace" id="whitespace">whitespace</a>
  : ' ' | \t | <a href="#newline">newline</a>

<a name="newline" id="newline">newline</a>
  : [[\r]? \n] | \r
</pre>

    <p><a href="#top">Go to top</a></p>
    <hr size="3">

    <h2><a name="help" id="help">How You Can Help</a></h2>

    <p><em>Although already using <span class="jsdoc">JSdoc&trade;</span> in <a
      href="../">my scripts</a>, I am still working on a way to transform the
      comments into a readable documentation, like <a
      href="http://java.sun.com/j2se/javadoc/">Javadoc</a>&trade; and [de]<a
      href="http://www.phpdoc.de/">PHPdoc</a> do.  The ultimate goal is to write
      the required script parser in JavaScript. <strong>If you have experience
      in this field (especially parser programming and Doclets), any help is
      greatly appreciated. Send e-mail to <a
        href="mailto:JSdoc@PointedEars.de%20%28Thomas%20'PointedEars'%20Lahn%29"
      >jsdoc@PointedEars.de</a>.</strong></em></p>

    <p><a href="#top">Go to top</a></p>
    <hr size="3">

    <h2><a name="copyright" id="copyright">Copyright &amp; Disclaimer</a></h2>

    <p>Copyright &copy; 2003-<?php echo date('Y', $mdate); ?>
      Thomas Lahn &lt;<a
      href="mailto:JSdoc@PointedEars.de%20%28Thomas%20'PointedEars'%20Lahn%29"
      >jsdoc@PointedEars.de</a>&gt;.</p>

    <p><small>JavaScriptDoc, JSdoc and the JSdoc logos are trademarks of
      PointedEars&nbsp;Software (PES). <strong>All rights reserved.</strong><br>
      Javadoc and JavaScript are <a href="http://www.sun.com/suntrademarks/#J"
      >trademarks of Sun Microsystems Inc.</a><br>
      Other names and labels are the property of their respective
      owners.</small></p>
    <hr size="4">

    <p><b>Updated:</b> <?php echo $modi; ?></p>

    <p><a name="online" id="online">This document online</a>: &lt;<a
      href="http://pointedears.de/scripts/JSdoc/"
      >http://pointedears.de/scripts/jsdoc/</a>&gt;</p>

    <p><a href="#top">Go to top</a></p>
  </body>
</html>