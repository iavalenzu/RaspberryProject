<head>

        
        <style>

.clearfix {
zoom: 1;
}

.card div {
display: block;
}

.card p {
display: block;
-webkit-margin-before: 1em;
-webkit-margin-after: 1em;
-webkit-margin-start: 0px;
-webkit-margin-end: 0px;
}

.card form {
display: block;
margin-top: 0em;
}

.hidden {
height: 0px;
width: 0px;
overflow: hidden;
visibility: hidden;
display: none !important;
}

.card label {
cursor: default;
}

.hidden-label {
position: absolute !important;
clip: rect(1px 1px 1px 1px);
clip: rect(1px, 1px, 1px, 1px);
height: 0px;
width: 0px;
overflow: hidden;
visibility: hidden;
}

.input-submit {
    font-family: Arial, sans-serif;
}

.input-email, .input-password, .input-text {
-moz-appearance: none;
-webkit-appearance: none;
appearance: none;
display: inline-block;
height: 36px;
padding: 0 8px;
margin: 0;
background: #fff;
border: 1px solid #d9d9d9;
border-top: 1px solid #c0c0c0;
-moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
box-sizing: border-box;
-moz-border-radius: 1px;
-webkit-border-radius: 1px;
border-radius: 1px;
font-size: 15px;
color: #404040;
}

.input-email:focus, .input-password:focus, .input-text:focus {
outline: none;
border: 1px solid #4d90fe;
-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
}

.rc-button {
display: inline-block;
min-width: 46px;
text-align: center;
color: #444;
font-size: 14px;
font-weight: 700;
height: 36px;
padding: 0 8px;
line-height: 36px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
-o-transition: all 0.218s;
-moz-transition: all 0.218s;
-webkit-transition: all 0.218s;
transition: all 0.218s;
border: 1px solid #dcdcdc;
background-color: #f5f5f5;
background-image: -webkit-linear-gradient(top,#f5f5f5,#f1f1f1);
background-image: -moz-linear-gradient(top,#f5f5f5,#f1f1f1);
background-image: -ms-linear-gradient(top,#f5f5f5,#f1f1f1);
background-image: -o-linear-gradient(top,#f5f5f5,#f1f1f1);
background-image: linear-gradient(top,#f5f5f5,#f1f1f1);
-o-transition: none;
-moz-user-select: none;
-webkit-user-select: none;
user-select: none;
cursor: default;
}

.rc-button:hover {
border: 1px solid #c6c6c6;
color: #333;
text-decoration: none;
-o-transition: all 0.0s;
-moz-transition: all 0.0s;
-webkit-transition: all 0.0s;
transition: all 0.0s;
background-color: #f8f8f8;
background-image: -webkit-linear-gradient(top,#f8f8f8,#f1f1f1);
background-image: -moz-linear-gradient(top,#f8f8f8,#f1f1f1);
background-image: -ms-linear-gradient(top,#f8f8f8,#f1f1f1);
background-image: -o-linear-gradient(top,#f8f8f8,#f1f1f1);
background-image: linear-gradient(top,#f8f8f8,#f1f1f1);
-moz-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}

.rc-button:active {
background-color: #f6f6f6;
background-image: -webkit-linear-gradient(top,#f6f6f6,#f1f1f1);
background-image: -moz-linear-gradient(top,#f6f6f6,#f1f1f1);
background-image: -ms-linear-gradient(top,#f6f6f6,#f1f1f1);
background-image: -o-linear-gradient(top,#f6f6f6,#f1f1f1);
background-image: linear-gradient(top,#f6f6f6,#f1f1f1);
-moz-box-shadow: 0 1px 2px rgba(0,0,0,0.1);
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.1);
box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.rc-button-submit {
border: 1px solid #3079ed !important;
color: #fff !important;
text-shadow: 0 1px rgba(0,0,0,0.1);
background-color: #4d90fe;
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -ms-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: linear-gradient(top,#4d90fe,#4787ed);
}

.rc-button-submit:hover {
border: 1px solid #2f5bb7;
color: #fff;
text-shadow: 0 1px rgba(0,0,0,0.3);
background-color: #357ae8;
background-image: -webkit-linear-gradient(top,#4d90fe,#357ae8);
background-image: -moz-linear-gradient(top,#4d90fe,#357ae8);
background-image: -ms-linear-gradient(top,#4d90fe,#357ae8);
background-image: -o-linear-gradient(top,#4d90fe,#357ae8);
background-image: linear-gradient(top,#4d90fe,#357ae8);
}

.rc-button-submit:active {
background-color: #357ae8;
background-image: -webkit-linear-gradient(top,#4d90fe,#357ae8);
background-image: -moz-linear-gradient(top,#4d90fe,#357ae8);
background-image: -ms-linear-gradient(top,#4d90fe,#357ae8);
background-image: -o-linear-gradient(top,#4d90fe,#357ae8);
background-image: linear-gradient(top,#4d90fe,#357ae8);
-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
box-shadow: inset 0 1px 2px rgba(0,0,0,0.3);
}

.card {
    
font-family: Arial, sans-serif;
font-size: 13px;
color: #404040;
direction: ltr;
    
background-color: #f7f7f7;
padding: 20px 25px 30px;
margin: 0 auto 25px;
width: 304px;
-moz-border-radius: 2px;
-webkit-border-radius: 2px;
border-radius: 2px;
-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.card {
margin-bottom: 20px;
}

.card *:first-child {
margin-top: 0;
}

.card .rc-button {
width: 100%;
padding: 0;
}

.signin-card {
width: 274px;
padding: 40px 40px;
}

.signin-card .input-email, .signin-card .input-password, .signin-card .input-text, .signin-card .input-submit {
width: 100%;
display: block;
margin-bottom: 10px;
z-index: 1;
position: relative;
-moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
box-sizing: border-box;
}

.signin-card .profile-name {
font-size: 16px;
font-weight: bold;
text-align: center;
margin: 10px 0 0;
height: 1em;
}

.signin-card #reauthEmail {
display: block;
margin-bottom: 10px;
line-height: 36px;
padding: 0 8px;
font-size: 15px;
color: #404040;
line-height: 2;
margin-bottom: 10px;
font-size: 14px;
text-align: center;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
-moz-box-sizing: border-box;
-webkit-box-sizing: border-box;
box-sizing: border-box;
}

.signin-card #Email, .signin-card #Password, .signin-card .captcha {
direction: ltr;
height: 44px;
font-size: 16px;
}

.signin-card #Email {
margin-bottom: 5px;
}

.signin-card #Email:hover, .signin-card #Email:focus, .signin-card #Password:hover, .signin-card #Password:focus {
z-index: 3;
}

.signin-card #Password {
margin-top: -1px;
}

.signin-card #Password:focus {
z-index: 3;
}

        </style>
	
</head>

	
<body>

    <div class="card signin-card">
        <!--<p class="profile-name"></p>-->
        <form novalidate="" method="post" action="" id="">
            <!--<span id="reauthEmail"></span>-->
            <input id="Email" name="Email" type="email" class="input-email" placeholder="Email" >
            <input id="Password" name="Password" type="password" placeholder="Password" class="input-password">
            <input id="SignIn" name="SignIn" class="input-submit rc-button rc-button-submit" type="submit" value="Sign in">
        </form>
        <!--<a id="link-forgot-passwd" href="">  Need help?  </a>-->
    </div>

</body>

</html>





<!--

<?php if (isset($partner_form)): ?>

    <?php
    $session_expire = $partner_form['PartnerForm']['session_expire'];
    $session_id = $partner_form['PartnerForm']['session_id'];
    $data = $partner_form['PartnerForm']['data'];

    $captcha = isset($data['captcha']) ? true : false;
    $email = isset($data['fields']['email']['value']) ? $data['fields']['email']['value'] : '';

    $timeout_millis = (strtotime($session_expire) - time()) * 1000;



    $css = <<<CSS

    <style type="text/css">
    
        .body {
        font-family: "Open Sans", Arial, Helvetica, sans-serif;
        font-size: 12px;
        line-height: 20px;
        color: #333;
        }

        /* Login pages */

        .dark-login {
          background: #1f1f1f;
        }

        .blue-login {
          background: #0072c6;
        }

        .light-login .login-container {
          border: 1px solid #5c5c5c;
        }

        .login-container {
          width: 290px;
          position: fixed;
          /*top: 50%;
          left: 50%;
          margin-left: -175px;*/
          padding: 15px 30px;
          background: #fff;
          /*margin-top: -200px;*/
          border: 1px solid #8f8f8f;
        }

        .login-container.opacity {
          background: rgba(255, 255, 255, 0.35)
        }

        .login-header {
          padding: 10px 0;
          margin-bottom: 5px;
        }

        .login-header.blue {
          background: #0072c6;
          text-align: center;
          color: #fff;
          margin-top: 15px;
          margin-bottom: 15px;
        }

        .login-header.bordered {
          text-align: left;
          border-left: 4px solid #0072c6;
          padding-left: 15px;
          margin-top: 10px;
          margin-bottom: 15px;
        }

        .login-field {
          margin-bottom: 10px;
          position: relative;
        }

        .login-field input {
          width: 100%;
        }

        .login-field i {
          font-size: 14px;
          position: absolute;
          right: 10px;
          top: 34px;
          color: #7b7b7b;
        }

        .login-button {
          margin-top: 20px;
          margin-bottom: 10px;
          position: relative;
        }

        .login-button .btn i {
          position: relative;
          top: 0;
        }

        .login-button .btn-block i {
          position: absolute;
          right: 10px;
          top: 9px;
        }

        .forgot-password {
          margin: 15px 0 5px;
        }
        

    /*Boton*/

    .btn {
      display: inline-block;
      *display: inline;
      padding: 5px 10px;
      margin-bottom: 0;
      *margin-left: .3em;
      font-size: 12px;
      line-height: 20px;
      color: #333;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      background-color: #e5e5e5;
      background-repeat: repeat-x;
      border: none !important;
      outline: none !important;
    }

    .btn-large {
      padding: 7px 12px 6px 12px;
      font-size: 13px;
    }

    .btn-block {
      display: block;
      text-align: center;
      width: 100%;
      padding-right: 0;
      padding-left: 0;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
    }

    .btn-block + .btn-block {
      margin-top: 5px;
    }

    input[type="submit"].btn-block,
    input[type="reset"].btn-block,
    input[type="button"].btn-block {
      width: 100%;
    }

    .btn.blue {
      background: #0072c6;
      color: #fff;
    }

    .btn.blue:hover {
      background: #0065af;
      color: #fff;
    }

    button.btn,
    input[type="submit"].btn {
      *padding-top: 3px;
      *padding-bottom: 3px;
      outline: none;
    }

    button.btn::-moz-focus-inner,
    input[type="submit"].btn::-moz-focus-inner {
      padding: 0;
      border: 0;
      outline: none;
    }

    button.btn.btn-large,
    input[type="submit"].btn.btn-large {
      *padding-top: 7px;
      *padding-bottom: 7px;
    }

    /*Input*/


    input[type="text"], 
    input[type="password"]{ 
      display: inline-block; 
      padding: 8px 7px 8px 7px; 
      font-size: 12px; 
      color: #5F5F5F; 
      font-family: Arial, Helvetica, sans-serif;
    }

    input[type="text"], 
    input[type="password"]{ 
      border: 1px solid #8f8f8f; 
      background: #ffffff; 
    }

    input[type="text"], 
    input[type="password"] { 
      height: 30px; 
      -webkit-box-sizing: border-box; 
         -moz-box-sizing: border-box; 
              box-sizing: border-box; 
          -ms-box-sizing: border-box; 
    }



    input[type="text"]:focus, 
    input[type="password"]:focus{ 
      outline: none;
      border: 1px solid #5c5c5c;
    }


    input{
      margin-left: 0;
    }


    /*Label*/

    label,
    button {
      font-size: 12px;
      font-weight: normal;
      line-height: 20px;
    }

    label { 
      margin-bottom: 4px; 
      display: inline-block; 
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      margin: 10px 0;
      font-family: inherit;
      font-weight: 300;
      line-height: 20px;
      color: inherit;
      text-rendering: optimizelegibility;
    }

    h1:first-child,
    h2:first-child,
    h3:first-child,
    h4:first-child,
    h5:first-child,
    h6:first-child {
      margin-top: 0;
    }

    h1:last-child,
    h2:last-child,
    h3:last-child,
    h4:last-child,
    h5:last-child,
    h6:last-child {
      margin-bottom: 0;
    }

    h1 small,
    h2 small,
    h3 small,
    h4 small,
    h5 small,
    h6 small {
      font-weight: normal;
      line-height: 1;
      color: #999999;
    }

    h1,
    h2,
    h3 {
      line-height: 40px;
    }

    h1 {
      font-size:38.5px
    }

    h2 {
      font-size:31.5px
    }

    h3 {
      font-size:24.5px
    }

    h4 {
      font-size:17.5px
    }

    h5 {
      font-size:14px
    }

    h6 {
      font-size:11.9px
    }

    h1 small {
      font-size: 24.5px;
    }

    h2 small {
      font-size: 17.5px;
    }

    h3 small {
      font-size: 14px;
    }

    h4 small {
      font-size: 14px;
    }


    h1:last-child,
    h2:last-child,
    h3:last-child,
    h4:last-child,
    h5:last-child,
    h6:last-child {
      margin-bottom: 0;
    }

    h1 small,
    h2 small,
    h3 small,
    h4 small,
    h5 small,
    h6 small {
      font-weight: normal;
      line-height: 1;
      color: #999999;
    }

    h1,
    h2,
    h3 {
      line-height: 40px;
    }

    h1 {
      font-size:38.5px
    }

    h2 {
      font-size:31.5px
    }

    h3 {
      font-size:24.5px
    }

    h4 {
      font-size:17.5px
    }

    h5 {
      font-size:14px
    }

    h6 {
      font-size:11.9px
    }

    h1 small {
      font-size: 24.5px;
    }

    h2 small {
      font-size: 17.5px;
    }

    h3 small {
      font-size: 14px;
    }

    h4 small {
      font-size: 14px;
    }

    .page-header {
      padding-bottom: 9px;
      margin: 20px 0 30px;
      border-bottom: 1px solid #eeeeee;
    }

    ul,
    ol {
      padding: 0;
      margin: 0 0 0 25px;
    }

    ul ul,
    ul ol,
    ol ol,
    ol ul {
      margin-bottom: 0;
    }

    li {
      line-height: 22px;
    }

    ul.unstyled,
    ol.unstyled {
      margin-left: 0;
      list-style: none;
    }

    ul.inline,
    ol.inline {
      margin-left: 0;
      list-style: none;
    }

    ul.inline > li,
    ol.inline > li {
      display: inline-block;
      *display: inline;
      padding-right: 5px;
      padding-left: 5px;
      *zoom: 1;
    }

    dl {
      margin-bottom: 20px;
    }

    dt,
    dd {
      line-height: 20px;
    }

    dt {
      font-weight: bold;
    }

    dd {
      margin-left: 10px;
    }

    .dl-horizontal {
      *zoom: 1;
    }

    .dl-horizontal:before,
    .dl-horizontal:after {
      display: table;
      line-height: 0;
      content: "";
    }

    .dl-horizontal:after {
      clear: both;
    }

    .dl-horizontal dt {
      float: left;
      width: 160px;
      overflow: hidden;
      clear: left;
      text-align: right;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .dl-horizontal dd {
      margin-left: 180px;
    }

    hr {
      margin: 20px 0;
      border: 0;
      border-top: 1px solid #eeeeee;
      border-bottom: 1px solid #ffffff;
    }

    abbr[title],
    abbr[data-original-title] {
      cursor: help;
      border-bottom: 1px dotted #999999;
    }

    abbr.initialism {
      font-size: 90%;
      text-transform: uppercase;
    }

    blockquote {
      padding: 0 0 0 15px;
      margin: 0 0 20px;
      border-left: 5px solid #eeeeee;
    }

    blockquote p {
      margin-bottom: 0;
      font-size: 14px;
      font-weight: 300;
      line-height: 22px;
    }

    blockquote small {
      display: block;
      line-height: 20px;
      color: #999999;
    }

    blockquote small:before {
      content: '\2014 \00A0';
    }

    blockquote.pull-right {
      float: right;
      padding-right: 15px;
      padding-left: 0;
      border-right: 5px solid #eeeeee;
      border-left: 0;
    }

    blockquote.pull-right p,
    blockquote.pull-right small {
      text-align: right;
    }

    blockquote.pull-right small:before {
      content: '';
    }

    blockquote.pull-right small:after {
      content: '\00A0 \2014';
    }

    q:before,
    q:after,
    blockquote:before,
    blockquote:after {
      content: "";
    }

    address {
      display: block;
      margin-bottom: 20px;
      font-style: normal;
      line-height: 20px;
    }

    code,
    pre {
      padding: 0 3px 2px;
      font-family: Monaco, Menlo, Consolas, "Courier New", monospace;
      font-size: 12px;
      color: #333333;
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    code {
      padding: 2px 4px;
      color: #d14;
      white-space: nowrap;
      background-color: #f7f7f9;
      border: 1px solid #e1e1e8;
    }

    pre {
      display: block;
      padding: 9.5px;
      margin: 0 0 10px;
      font-size: 13px;
      line-height: 20px;
      word-break: break-all;
      word-wrap: break-word;
      white-space: pre;
      white-space: pre-wrap;
      background-color: #f5f5f5;
      border: 1px solid #ccc;
      border: 1px solid rgba(0, 0, 0, 0.15);
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    pre.prettyprint {
      margin-bottom: 20px;
    }

    pre code {
      padding: 0;
      color: inherit;
      white-space: pre;
      white-space: pre-wrap;
      background-color: transparent;
      border: 0;
    }

    .pre-scrollable {
      max-height: 340px;
      overflow-y: scroll;
    }

    form {
      margin: 0;
    }

    form + form {
      margin: 0 0 20px 0;
    }

    fieldset {
      padding: 0;
      margin: 0;
      border: 0;
    }

    legend { 
      display: block; 
      width: 100%; 
      padding: 0; 
      font-size: 14px; 
      line-height: 30px; 
      color: #5F5F5F; 
      border: 0; 
      border-bottom: 1px solid #dedede; 
      font-weight: 600; 
    }

    legend small { 
      font-size: 15px; 
      color: #999999; 
    }

    label,
    button {
      font-size: 12px;
      font-weight: normal;
      line-height: 20px;
    }

    label { 
      margin-bottom: 4px; 
      display: inline-block; 
    }

    label.form-button {
      margin-right: 14px;
    }

    select, 
    textarea, 
    input[type="text"], 
    input[type="password"], 
    input[type="datetime"], 
    input[type="datetime-local"], 
    input[type="date"], 
    input[type="month"], 
    input[type="time"], 
    input[type="week"], 
    input[type="number"], 
    input[type="email"], 
    input[type="url"], 
    input[type="search"], 
    input[type="tel"], 
    input[type="color"], 
    .uneditable-input  { 
      display: inline-block; 
      padding: 8px 7px 8px 7px; 
      font-size: 12px; 
      color: #5F5F5F; 
      font-family: Arial, Helvetica, sans-serif;
    }

    select:focus, 
    textarea:focus, 
    input[type="text"]:focus, 
    input[type="password"]:focus, 
    input[type="datetime"]:focus, 
    input[type="datetime-local"]:focus, 
    input[type="date"]:focus, 
    input[type="month"]:focus, 
    input[type="time"]:focus, 
    input[type="week"]:focus, 
    input[type="number"]:focus, 
    input[type="email"]:focus, 
    input[type="url"]:focus, 
    input[type="search"]:focus, 
    input[type="tel"]:focus, 
    input[type="color"]:focus, 
    .uneditable-input  { 
      outline: none;
      border: 1px solid #5c5c5c;
    }

    input[type="search"] { 
      -webkit-border-radius: 0; 
      -moz-border-radius: 0; 
      -webkit-appearance: none; 
    }

    input[disabled], 
    select[disabled], 
    textarea[disabled], 
    input[readonly], 
    select[readonly], 
    textarea[readonly] { 
      cursor: not-allowed; 
      background-color: #f5f5f5; 
      color: #999999; 
    }

    input[type=submit][disabled], input[type=button][disabled] { 
      color: #fff; 
    }

    input[type="radio"][disabled], 
    input[type="checkbox"][disabled], 
    input[type="radio"][readonly], 
    input[type="checkbox"][readonly] { 
      background-color: transparent; 
    }

    textarea { 
      max-width: 100%;
      -webkit-box-sizing: border-box; 
         -moz-box-sizing: border-box; 
              box-sizing: border-box; 
          -ms-box-sizing: border-box; 
    }

    select { 
      width: 220px; 
      height: 30px; 
      padding: 5px; 
      border: 1px solid #d2d2d2; 
      background-color: #ffffff; 
    }

    .dual_select select {
      width: 40%;
    }

    select:focus { 
      box-shadow: none; 
      -webkit-box-shadow: none; 
      -moz-box-shadow: none; 
    }

    select[multiple] {
      height: auto;
    }

    textarea {
      min-height: 75px;
    }

    textarea, 
    input[type="text"], 
    input[type="password"], 
    input[type="datetime"], 
    input[type="datetime-local"], 
    input[type="date"], 
    input[type="month"], 
    input[type="time"], 
    input[type="week"], 
    input[type="number"], 
    input[type="email"], 
    input[type="url"], 
    input[type="search"], 
    input[type="tel"], 
    input[type="color"], 
    .uneditable-input  { 
      border: 1px solid #8f8f8f; 
      background: #ffffff; 
    }

    input[type="text"], 
    input[type="password"], 
    input[type="datetime"], 
    input[type="datetime-local"], 
    input[type="date"], 
    input[type="month"], 
    input[type="time"], 
    input[type="week"], 
    input[type="number"], 
    input[type="email"], 
    input[type="url"], 
    input[type="search"], 
    input[type="tel"], 
    input[type="color"] { 
      height: 30px; 
      -webkit-box-sizing: border-box; 
         -moz-box-sizing: border-box; 
              box-sizing: border-box; 
          -ms-box-sizing: border-box; 
    }

    input[class*="span"], 
    select[class*="span"], 
    textarea[class*="span"], 
    .uneditable-input[class*="span"], 
    .row-fluid input[class*="span"], 
    .row-fluid select[class*="span"], 
    .row-fluid textarea[class*="span"], 
    .row-fluid .uneditable-input[class*="span"] { 
      float: none; 
      margin-left: 0; 
    }

    .input-append input[class*="span"], 
    .input-append .uneditable-input[class*="span"], 
    .input-prepend input[class*="span"], 
    .input-prepend .uneditable-input[class*="span"], 
    .row-fluid input[class*="span"], 
    .row-fluid select[class*="span"], 
    .row-fluid textarea[class*="span"], 
    .row-fluid .uneditable-input[class*="span"], 
    .row-fluid .input-prepend [class*="span"], 
    .row-fluid .input-append [class*="span"] { 
      display: inline-block; 
    }

    input[type="radio"], input[type="checkbox"] { 
      *margin-top: 0; 
      margin-top: 1px \9; 
      line-height: normal; 
      cursor: pointer; 
    }

    input[type="file"], 
    input[type="image"], 
    input[type="submit"], 
    input[type="reset"], 
    input[type="button"], 
    input[type="radio"], 
    input[type="checkbox"] { 
      width: auto;
      text-decoration: none;
      float: none !important;
    }

    .uneditable-input, .uneditable-textarea { 
      color: #999999; 
      background-color: #fcfcfc; 
      border-color: #dedede; 
      cursor: not-allowed; 
    }

    .uneditable-input { 
      overflow: hidden; 
      white-space: nowrap; 
    }

    .uneditable-textarea { 
      width: auto; 
      height: auto; 
    }

    input:-moz-placeholder, 
    textarea:-moz-placeholder { 
      color: #999999; 
      text-decoration: none;
    }

    input:-ms-input-placeholder, 
    textarea:-ms-input-placeholder { 
      color: #999999;
      text-decoration: none;
    }

    input::-webkit-input-placeholder, 
    textarea::-webkit-input-placeholder { 
      color: #999999;
      text-decoration: none;
    }

    label.radio,
    label.checkbox {
      min-height: 20px;
      margin-right: 15px;
      margin-top: 5px;
    }

    label.radio input[type="radio"],
    label.checkbox input[type="checkbox"] {
      float: left;
    }

    label.radio .radio {
      margin-top: -4px !important;
      margin-right: 3px !important;
    }

    label.checkbox .checker {
      margin-top: -2px !important;
      margin-right: 3px !important;
    }

    .controls > .radio:first-child,
    .controls > .checkbox:first-child {
      padding-top: 5px;
    }

    .radio.inline,
    .checkbox.inline {
      display: inline-block;
      padding-top: 5px;
      margin-bottom: 0;
      vertical-align: middle;
    }

    .radio.inline + .radio.inline,
    .checkbox.inline + .checkbox.inline {
      margin-left: 10px;
    }

    .input-mini {
      width: 60px;
    }

    .input-small {
      width: 90px;
    }

    .input-medium {
      width: 150px;
    }

    .input-large {
      width: 210px;
    }

    .input-xlarge {
      width: 270px;
    }

    .input-xxlarge {
      width: 530px;
    }

    input[class*="span"],
    select[class*="span"],
    textarea[class*="span"],
    .uneditable-input[class*="span"],
    .row-fluid input[class*="span"],
    .row-fluid select[class*="span"],
    .row-fluid textarea[class*="span"],
    .row-fluid .uneditable-input[class*="span"] {
      float: none;
      margin-left: 0;
    }

    .input-append input[class*="span"],
    .input-append .uneditable-input[class*="span"],
    .input-prepend input[class*="span"],
    .input-prepend .uneditable-input[class*="span"],
    .row-fluid input[class*="span"],
    .row-fluid select[class*="span"],
    .row-fluid textarea[class*="span"],
    .row-fluid .uneditable-input[class*="span"],
    .row-fluid .input-prepend [class*="span"],
    .row-fluid .input-append [class*="span"] {
      display: inline-block;
    }

    input,
    textarea,
    .uneditable-input {
      margin-left: 0;
    }

    .controls-row [class*="span"] + [class*="span"] {
      margin-left: 20px;
    }

    input.span12,
    textarea.span12,
    .uneditable-input.span12 {
      width: 926px;
    }

    input.span11,
    textarea.span11,
    .uneditable-input.span11 {
      width: 846px;
    }

    input.span10,
    textarea.span10,
    .uneditable-input.span10 {
      width: 766px;
    }

    input.span9,
    textarea.span9,
    .uneditable-input.span9 {
      width: 686px;
    }

    input.span8,
    textarea.span8,
    .uneditable-input.span8 {
      width: 606px;
    }

    input.span7,
    textarea.span7,
    .uneditable-input.span7 {
      width: 526px;
    }

    input.span6,
    textarea.span6,
    .uneditable-input.span6 {
      width: 446px;
    }

    input.span5,
    textarea.span5,
    .uneditable-input.span5 {
      width: 366px;
    }

    input.span4,
    textarea.span4,
    .uneditable-input.span4 {
      width: 286px;
    }

    input.span3,
    textarea.span3,
    .uneditable-input.span3 {
      width: 206px;
    }

    input.span2,
    textarea.span2,
    .uneditable-input.span2 {
      width: 126px;
    }

    input.span1,
    textarea.span1,
    .uneditable-input.span1 {
      width: 46px;
    }

    .controls-row {
      *zoom: 1;
    }

    .controls-row:before,
    .controls-row:after {
      display: table;
      line-height: 0;
      content: "";
    }

    .controls-row:after {
      clear: both;
    }

    .controls-row [class*="span"],
    .row-fluid .controls-row [class*="span"] {
      float: left;
    }

    .controls-row .checkbox[class*="span"],
    .controls-row .radio[class*="span"] {
      padding-top: 5px;
    }

    input[disabled],
    select[disabled],
    textarea[disabled],
    input[readonly],
    select[readonly],
    textarea[readonly] {
      cursor: default;
      background-color: #fff;
    }

    input[type="radio"][disabled],
    input[type="checkbox"][disabled],
    input[type="radio"][readonly],
    input[type="checkbox"][readonly] {
      background-color: transparent;
    }

    .control-group.warning .control-label,
    .control-group.warning .help-block,
    .control-group.warning .help-inline {
      color: #c09853;
    }

    .control-group.warning .checkbox,
    .control-group.warning .radio,
    .control-group.warning input,
    .control-group.warning select,
    .control-group.warning textarea {
      color: #c09853;
    }

    .control-group.warning input,
    .control-group.warning select,
    .control-group.warning textarea,
    input.warning  {
      border-color: #c09853;
    }

    .control-group.warning input:focus,
    .control-group.warning select:focus,
    .control-group.warning textarea:focus,
    input.warning:focus {
      border-color: #c09853;
      background: #fff;
    }

    .control-group.warning .input-prepend .add-on,
    .control-group.warning .input-append .add-on {
      color: #c09853;
      background-color: #fcf8e3;
      border-color: #c09853;
    }

    .control-group.error .control-label,
    .control-group.error .help-block,
    .control-group.error .help-inline {
      color: #b94a48;
    }

    .control-group.error .checkbox,
    .control-group.error .radio,
    .control-group.error input,
    .control-group.error select,
    .control-group.error textarea {
      color: #b94a48;
    }

    .control-group.error input,
    .control-group.error select,
    .control-group.error textarea,
    input.error {
      border-color: #b94a48;
    }

    .control-group.error input:focus,
    .control-group.error select:focus,
    .control-group.error textarea:focus,
    input.error:focus {
      border-color: #b94a48;
    }

    .control-group.error .input-prepend .add-on,
    .control-group.error .input-append .add-on {
      color: #b94a48;
      background-color: #f2dede;
      border-color: #b94a48;
    }

    .control-group.success .control-label,
    .control-group.success .help-block,
    .control-group.success .help-inline {
      color: #468847;
    }

    .control-group.success .checkbox,
    .control-group.success .radio,
    .control-group.success input,
    .control-group.success select,
    .control-group.success textarea {
      color: #468847;
    }

    .control-group.success input,
    .control-group.success select,
    .control-group.success textarea,
    input.valid {
      border-color: #468847;
    }

    .control-group.success input:focus,
    .control-group.success select:focus,
    .control-group.success textarea:focus {
      border-color: #468847;
    }

    .control-group.success .input-prepend .add-on,
    .control-group.success .input-append .add-on {
      color: #468847;
      background-color: #dff0d8;
      border-color: #468847;
    }

    .control-group.info .control-label,
    .control-group.info .help-block,
    .control-group.info .help-inline {
      color: #3a87ad;
    }

    .control-group.info .checkbox,
    .control-group.info .radio,
    .control-group.info input,
    .control-group.info select,
    .control-group.info textarea {
      color: #3a87ad;
    }

    .control-group.info input,
    .control-group.info select,
    .control-group.info textarea {
      border-color: #3a87ad;
    }

    .control-group.info input:focus,
    .control-group.info select:focus,
    .control-group.info textarea:focus {
      border-color: #3a87ad;
    }

    .control-group.info .input-prepend .add-on,
    .control-group.info .input-append .add-on {
      color: #3a87ad;
      background-color: #d9edf7;
      border-color: #3a87ad;
    }

    input:focus:invalid,
    textarea:focus:invalid,
    select:focus:invalid {
      color: #b94a48;
      border-color: #ee5f5b;
    }

    input:focus:invalid:focus,
    textarea:focus:invalid:focus,
    select:focus:invalid:focus {
      border-color: #e9322d;
    }

    .form-actions {
      padding: 19px 20px 20px;
      margin-top: 20px;
      margin-bottom: 20px;
      background-color: #f5f5f5;
      border-top: 1px solid #e5e5e5;
      *zoom: 1;
    }

    .form-actions:before,
    .form-actions:after {
      display: table;
      line-height: 0;
      content: "";
    }

    .form-actions:after {
      clear: both;
    }

    .help-block,
    .help-inline {
      color: #595959;
    }

    .help-block {
      display: block;
      margin-bottom: 10px;
    }

    .help-inline {
      display: inline-block;
      *display: inline;
      padding-left: 5px;
      vertical-align: middle;
      *zoom: 1;
    }

    .input-append,
    .input-prepend {
      display: inline-block;
      font-size: 0;
      white-space: nowrap;
      vertical-align: middle;
    }

    .input-append input,
    .input-prepend input,
    .input-append select,
    .input-prepend select,
    .input-append .uneditable-input,
    .input-prepend .uneditable-input,
    .input-append .dropdown-menu,
    .input-prepend .dropdown-menu,
    .input-append .popover,
    .input-prepend .popover {
      font-size: 12px;
    }

    .input-append input,
    .input-prepend input,
    .input-append select,
    .input-prepend select,
    .input-append .uneditable-input,
    .input-prepend .uneditable-input {
      position: relative;
      margin-bottom: 0;
      *margin-left: 0;
      vertical-align: top;
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .input-append input:focus,
    .input-prepend input:focus,
    .input-append select:focus,
    .input-prepend select:focus,
    .input-append .uneditable-input:focus,
    .input-prepend .uneditable-input:focus {
      z-index: 2;
    }

    .input-append .add-on,
    .input-prepend .add-on {
      display: inline-block;
      width: auto;
      height: 20px;
      min-width: 16px;
      padding: 4px 5px;
      font-size: 14px;
      font-weight: normal;
      line-height: 20px;
      text-align: center;
      text-shadow: 0 1px 0 #ffffff;
      background-color: #eeeeee;
      border: 1px solid #8f8f8f;
    }

    .input-append .add-on,
    .input-prepend .add-on,
    .input-append .btn,
    .input-prepend .btn,
    .input-append .btn-group > .dropdown-toggle,
    .input-prepend .btn-group > .dropdown-toggle {
      vertical-align: top;
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .input-append .active,
    .input-prepend .active {
      background-color: #a9dba9;
      border-color: #46a546;
    }

    .input-prepend .add-on,
    .input-prepend .btn {
      margin-right: -1px;
    }

    .input-prepend .add-on:first-child,
    .input-prepend .btn:first-child {
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .input-append input,
    .input-append select,
    .input-append .uneditable-input {
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .input-append input + .btn-group .btn:last-child,
    .input-append select + .btn-group .btn:last-child,
    .input-append .uneditable-input + .btn-group .btn:last-child {
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .input-append .add-on,
    .input-append .btn,
    .input-append .btn-group {
      margin-left: -1px;
    }

    .input-append .add-on:last-child,
    .input-append .btn:last-child,
    .input-append .btn-group:last-child > .dropdown-toggle {
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .input-prepend.input-append input,
    .input-prepend.input-append select,
    .input-prepend.input-append .uneditable-input {
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .input-prepend.input-append input + .btn-group .btn,
    .input-prepend.input-append select + .btn-group .btn,
    .input-prepend.input-append .uneditable-input + .btn-group .btn {
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .input-prepend.input-append .add-on:first-child,
    .input-prepend.input-append .btn:first-child {
      margin-right: -1px;
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .input-prepend.input-append .add-on:last-child,
    .input-prepend.input-append .btn:last-child {
      margin-left: -1px;
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .input-prepend.input-append .btn-group:first-child {
      margin-left: 0;
    }

    /* Allow for input prepend/append in search forms */

    .form-search .input-append .search-query,
    .form-search .input-prepend .search-query {
      -webkit-border-radius: 0;
         -moz-border-radius: 0;
              border-radius: 0;
    }

    .form-search input,
    .form-inline input,
    .form-horizontal input,
    .form-search textarea,
    .form-inline textarea,
    .form-horizontal textarea,
    .form-search select,
    .form-inline select,
    .form-horizontal select,
    .form-search .help-inline,
    .form-inline .help-inline,
    .form-horizontal .help-inline,
    .form-search .uneditable-input,
    .form-inline .uneditable-input,
    .form-horizontal .uneditable-input,
    .form-search .input-prepend,
    .form-inline .input-prepend,
    .form-horizontal .input-prepend,
    .form-search .input-append,
    .form-inline .input-append,
    .form-horizontal .input-append {
      display: inline-block;
      *display: inline;
      margin-bottom: 0;
      vertical-align: middle;
      *zoom: 1;
    }

    .form-search .hide,
    .form-inline .hide,
    .form-horizontal .hide {
      display: none;
    }

    .form-search label,
    .form-inline label,
    .form-search .btn-group,
    .form-inline .btn-group {
      display: inline-block;
    }

    .form-search .input-append,
    .form-inline .input-append,
    .form-search .input-prepend,
    .form-inline .input-prepend {
      margin-bottom: 0;
    }

    .form-search .radio,
    .form-search .checkbox,
    .form-inline .radio,
    .form-inline .checkbox {
      padding-left: 0;
      margin-bottom: 0;
      vertical-align: middle;
    }

    .form-search .radio input[type="radio"],
    .form-search .checkbox input[type="checkbox"],
    .form-inline .radio input[type="radio"],
    .form-inline .checkbox input[type="checkbox"] {
      float: left;
      margin-right: 3px;
      margin-left: 0;
    }

    .control-group {
      margin-bottom: 10px;
    }

    legend + .control-group {
      margin-top: 20px;
      -webkit-margin-top-collapse: separate;
    }

    .form-horizontal .control-group {
      margin-bottom: 20px;
      *zoom: 1;
    }

    .form-horizontal .control-group:before,
    .form-horizontal .control-group:after {
      display: table;
      line-height: 0;
      content: "";
    }

    .form-horizontal .control-group:after {
      clear: both;
    }

    .form-horizontal .control-label {
      float: left;
      width: 160px;
      padding-top: 5px;
      text-align: right;
    }

    .form-horizontal .controls {
      *display: inline-block;
      *padding-left: 20px;
      margin-left: 180px;
      *margin-left: 0;
    }

    .form-horizontal .controls:first-child {
      *padding-left: 180px;
    }

    .form-horizontal .help-block {
      margin-bottom: 0;
    }

    .form-horizontal input + .help-block,
    .form-horizontal select + .help-block,
    .form-horizontal textarea + .help-block,
    .form-horizontal .uneditable-input + .help-block,
    .form-horizontal .input-prepend + .help-block,
    .form-horizontal .input-append + .help-block {
      margin-top: 10px;
    }

    .form-horizontal .form-actions {
      padding-left: 180px;
    }

    table {
      max-width: 100%;
      background-color: transparent;
      border-collapse: collapse;
      border-spacing: 0;
    }

    .no_padding .table_options {
      padding: 12px;
    }

    .top_options {
      margin-bottom: 10px;
    }

    .bottom_options {
      margin-top: 15px;
    }

    .table_options:after {
      content: "";
      display: block;
      clear: both;
    }

    .table_options > div > span {
      display: inline-block;
      vertical-align: middle;
      position: relative;
      top: 1px;
      margin-right: 4px;
    }

    .table {
      width: 100%;
    }

    .table.multimedia img {
      width: 30px;
    }

    .table th,
    .table td {
      padding: 8px;
      line-height: 20px;
      text-align: left;
      vertical-align: top;
      border-top: 1px solid #dedede;
      vertical-align: middle;
    }

    .table th {
      font-weight: 600;
      font-size: 13px;
      vertical-align: middle;
    }

    .table th.table-check,
    .table td.table-check {
      width: 15px;
    }

    .table th.table-icon,
    .table td.table-icon {
      width: 20px;
    }

    .table th.table-icon i,
    .table td.table-icon i {
      font-size: 13px;
      color: #aaaaaa;
      position: relative;
      top: 1px;
      cursor: pointer;
    }

    .table td.table-icon.active i {
      color: #f8a31f;
    }

    .table td.table-fixed-medium {
      width: 200px;
    }

    .table tr.active td,
    .table tr.active {
      background: #deecfa !important;
    }

    .table caption + thead tr:first-child th,
    .table caption + thead tr:first-child td,
    .table colgroup + thead tr:first-child th,
    .table colgroup + thead tr:first-child td,
    .table thead:first-child tr:first-child th,
    .table thead:first-child tr:first-child td {
      border-top: 0;
    }

    .table tbody + tbody {
      border-top: 2px solid #dedede;
    }

    .table .table {
      background-color: #ffffff;
    }

    .table-condensed th,
    .table-condensed td {
      padding: 4px 5px;
    }

    .table-bordered {
      border: 1px solid #dedede;
      border-collapse: separate;
      *border-collapse: collapse;
      border-left: 0;
    }

    .table-bordered th,
    .table-bordered td {
      border-left: 1px solid #dedede;
    }

    .table-bordered caption + thead tr:first-child th,
    .table-bordered caption + tbody tr:first-child th,
    .table-bordered caption + tbody tr:first-child td,
    .table-bordered colgroup + thead tr:first-child th,
    .table-bordered colgroup + tbody tr:first-child th,
    .table-bordered colgroup + tbody tr:first-child td,
    .table-bordered thead:first-child tr:first-child th,
    .table-bordered tbody:first-child tr:first-child th,
    .table-bordered tbody:first-child tr:first-child td {
      border-top: 0;
    }

    .table-bordered thead:first-child tr:first-child > th:first-child,
    .table-bordered tbody:first-child tr:first-child > td:first-child,
    .table-bordered tbody:first-child tr:first-child > th:first-child {
      -webkit-border-top-left-radius: 0;
              border-top-left-radius: 0;
      -moz-border-radius-topleft: 0;
    }

    .table-bordered thead:first-child tr:first-child > th:last-child,
    .table-bordered tbody:first-child tr:first-child > td:last-child,
    .table-bordered tbody:first-child tr:first-child > th:last-child {
      -webkit-border-top-right-radius: 0;
              border-top-right-radius: 0;
      -moz-border-radius-topright: 0;
    }

    .table-bordered thead:last-child tr:last-child > th:first-child,
    .table-bordered tbody:last-child tr:last-child > td:first-child,
    .table-bordered tbody:last-child tr:last-child > th:first-child,
    .table-bordered tfoot:last-child tr:last-child > td:first-child,
    .table-bordered tfoot:last-child tr:last-child > th:first-child {
      -webkit-border-bottom-left-radius: 0;
              border-bottom-left-radius: 0;
      -moz-border-radius-bottomleft: 0;
    }

    .table-bordered thead:last-child tr:last-child > th:last-child,
    .table-bordered tbody:last-child tr:last-child > td:last-child,
    .table-bordered tbody:last-child tr:last-child > th:last-child,
    .table-bordered tfoot:last-child tr:last-child > td:last-child,
    .table-bordered tfoot:last-child tr:last-child > th:last-child {
      -webkit-border-bottom-right-radius: 0;
              border-bottom-right-radius: 0;
      -moz-border-radius-bottomright: 0;
    }

    .table-bordered tfoot + tbody:last-child tr:last-child td:first-child {
      -webkit-border-bottom-left-radius: 0;
              border-bottom-left-radius: 0;
      -moz-border-radius-bottomleft: 0;
    }

    .table-bordered tfoot + tbody:last-child tr:last-child td:last-child {
      -webkit-border-bottom-right-radius: 0;
              border-bottom-right-radius: 0;
      -moz-border-radius-bottomright: 0;
    }

    .table-bordered caption + thead tr:first-child th:first-child,
    .table-bordered caption + tbody tr:first-child td:first-child,
    .table-bordered colgroup + thead tr:first-child th:first-child,
    .table-bordered colgroup + tbody tr:first-child td:first-child {
      -webkit-border-top-left-radius: 4px;
              border-top-left-radius: 4px;
      -moz-border-radius-topleft: 4px;
    }

    .table-bordered caption + thead tr:first-child th:last-child,
    .table-bordered caption + tbody tr:first-child td:last-child,
    .table-bordered colgroup + thead tr:first-child th:last-child,
    .table-bordered colgroup + tbody tr:first-child td:last-child {
      -webkit-border-top-right-radius: 0;
              border-top-right-radius: 0;
      -moz-border-radius-topright: 0;
    }

    .table-striped tbody > tr:nth-child(odd) > td,
    .table-striped tbody > tr:nth-child(odd) > th {
      background-color: #f9f9f9;
    }

    .table-hover tbody tr:hover > td,
    .table-hover tbody tr:hover > th {
      background-color: #f5f5f5;
    }

    table td[class*="span"],
    table th[class*="span"],
    .row-fluid table td[class*="span"],
    .row-fluid table th[class*="span"] {
      display: table-cell;
      float: none;
      margin-left: 0;
    }

    .table td.span1,
    .table th.span1 {
      float: none;
      width: 44px;
      margin-left: 0;
    }

    .table td.span2,
    .table th.span2 {
      float: none;
      width: 124px;
      margin-left: 0;
    }

    .table td.span3,
    .table th.span3 {
      float: none;
      width: 204px;
      margin-left: 0;
    }

    .table td.span4,
    .table th.span4 {
      float: none;
      width: 284px;
      margin-left: 0;
    }

    .table td.span5,
    .table th.span5 {
      float: none;
      width: 364px;
      margin-left: 0;
    }

    .table td.span6,
    .table th.span6 {
      float: none;
      width: 444px;
      margin-left: 0;
    }

    .table td.span7,
    .table th.span7 {
      float: none;
      width: 524px;
      margin-left: 0;
    }

    .table td.span8,
    .table th.span8 {
      float: none;
      width: 604px;
      margin-left: 0;
    }

    .table td.span9,
    .table th.span9 {
      float: none;
      width: 684px;
      margin-left: 0;
    }

    .table td.span10,
    .table th.span10 {
      float: none;
      width: 764px;
      margin-left: 0;
    }

    .table td.span11,
    .table th.span11 {
      float: none;
      width: 844px;
      margin-left: 0;
    }

    .table td.span12,
    .table th.span12 {
      float: none;
      width: 924px;
      margin-left: 0;
    }

    .table tbody tr.success > td {
      background-color: #dff0d8;
    }

    .table tbody tr.error > td {
      background-color: #f2dede;
    }

    .table tbody tr.warning > td {
      background-color: #fcf8e3;
    }

    .table tbody tr.info > td {
      background-color: #d9edf7;
    }

    .table-hover tbody tr.success:hover > td {
      background-color: #d0e9c6;
    }

    .table-hover tbody tr.error:hover > td {
      background-color: #ebcccc;
    }

    .table-hover tbody tr.warning:hover > td {
      background-color: #faf2cc;
    }

    .table-hover tbody tr.info:hover > td {
      background-color: #c4e3f3;
    }

    [class^="icon-"],
    [class*=" icon-"] {
      display: inline-block;
      width: 14px;
      height: 14px;
      margin-top: 1px;
      *margin-right: .3em;
      line-height: 14px;
      vertical-align: text-top;
      background-image: url("http://leviatz.com/flatpoint/img/glyphicons-halflings.png");
      background-position: 14px 14px;
      background-repeat: no-repeat;
    }

    /* White icons with optional class, or on hover/focus/active states of certain elements */

    .icon-white,
    .nav-pills > .active > a > [class^="icon-"],
    .nav-pills > .active > a > [class*=" icon-"],
    .nav-list > .active > a > [class^="icon-"],
    .nav-list > .active > a > [class*=" icon-"],
    .navbar-inverse .nav > .active > a > [class^="icon-"],
    .navbar-inverse .nav > .active > a > [class*=" icon-"],
    .dropdown-menu > li > a:hover > [class^="icon-"],
    .dropdown-menu > li > a:focus > [class^="icon-"],
    .dropdown-menu > li > a:hover > [class*=" icon-"],
    .dropdown-menu > li > a:focus > [class*=" icon-"],
    .dropdown-menu > .active > a > [class^="icon-"],
    .dropdown-menu > .active > a > [class*=" icon-"],
    .dropdown-submenu:hover > a > [class^="icon-"],
    .dropdown-submenu:focus > a > [class^="icon-"],
    .dropdown-submenu:hover > a > [class*=" icon-"],
    .dropdown-submenu:focus > a > [class*=" icon-"] {
      background-image: url("http://leviatz.com/flatpoint/img/glyphicons-halflings-white.png");
    }

    .icon-user {
      background-position: -168px 0;
    }

    .icon-lock {
      background-position: -287px -24px;
    }

    </style>

CSS;

    $css = preg_replace("/'/", '"', $css);
    $css_ws = preg_replace("/\s+/", " ", $css);



    $html = <<<HTML

    <div class="body login-container">
        <div class="login-header">
            <h4>Sign in</h4>
        </div>
        <form >
            <div class="login-field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Username">
                <i class="icon-user"></i>
            </div>
            <div class="login-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
                <i class="icon-lock"></i>
            </div>
            <div class="login-button">
                <button type="submit" class="btn btn-large btn-block blue">SIGN IN <i class="icon-arrow-right"></i></button>
            </div>
            <div class="forgot-password">
                <a href="#">Forgot password?</a>
            </div>
        </form>
    </div>

HTML;

    $html_ws = preg_replace("/\s+/", " ", $html);



    /*
     * El codigo javascript que sera enviado al cliente
     * 
     */

    $javascript = <<<JAVASCRIPT

$( document ).ready(function() {
 
    $('head').append('$css_ws');

    $('#loginform').html('$html_ws');
    
    setTimeout(function(){
        location.reload(true);
    },$timeout_millis);    
        
});

JAVASCRIPT;

    $javascript = preg_replace("/\s+/", " ", $javascript);

    echo $javascript;

endif;
?>


-->