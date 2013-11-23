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
/*margin: 0 auto 25px;*/
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