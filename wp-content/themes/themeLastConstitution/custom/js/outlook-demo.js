


$(function() {
    console.log('*************************');
    console.log('premiere function');
    console.log('**************************');
var authEndpoint = 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize?';
var redirectUri = 'http://localhost/test_test_tes/index.php/jeu/';
var appId = '187bcd71-2211-41a7-83e5-95be1265b2e4';
var scopes = 'openid profile User.Read Mail.Read';
  // Check for browser support for sessionStorage
  if (typeof(Storage) === 'undefined') {
      console.log('*************************');
    console.log('premiere function 1');
    console.log('**************************');
    render('#unsupportedbrowser');
    return;
  }

  // Check for browser support for crypto.getRandomValues
  var cryptObj = window.crypto || window.msCrypto; // For IE11
  if (cryptObj === undefined || cryptObj.getRandomValues === 'undefined') {
      console.log('*************************');
    console.log('premiere function 2');
    console.log('**************************');
    render('#unsupportedbrowser');
    return;
  }

  render(window.location.hash);

  $(window).on('hashchange', function() {
    render(window.location.hash);
  });

  function render(hash) {
        console.log('*************************');
    console.log('render');
    console.log('**************************');

    var action = hash.split('=')[0];

    // Hide everything
    $('.main-container .page').hide();

    var isAuthenticated = (sessionStorage.accessToken != null && sessionStorage.accessToken.length > 0);
renderNav(isAuthenticated);
renderTokens();

    var pagemap = {

      // Welcome page
      '': function() {
        renderWelcome(isAuthenticated);
      },

      // Receive access token
'#access_token': function() {
      console.log('*************************');
    console.log('access token');
    console.log('**************************');
  handleTokenResponse(hash);             
},
      // Signout
'#signout': function () {
      console.log('*************************');
    console.log('signout');
    console.log('**************************');
  clearUserState();

  // Redirect to home page
  window.location.hash = 'http://localhost/test_test_tes/index.php/jeu/';
},

      // Error display
'#error': function () {
      console.log('*************************');
    console.log('error');
    console.log('**************************');
  var errorresponse = parseHashParams(hash);
  if (errorresponse.error === 'login_required' ||
      errorresponse.error === 'interaction_required') {
  console.log('*************************');
    console.log('error 1');
    console.log('**************************');
    // For these errors redirect the browser to the login
    // page.
    window.location = buildAuthUrl();
  } else {
      console.log('*************************');
    console.log('error 2');
    console.log('**************************');
    renderError(errorresponse.error, errorresponse.error_description);
  }
},
      // Display inbox
'#inbox': function () {
      console.log('*************************');
    console.log('inbox');
    console.log('**************************');
  if (isAuthenticated) {
    renderInbox();  
  } else {
    // Redirect to home page
    window.location.hash = 'http://localhost/test_test_tes/index.php/jeu/';
  }
},
      // Shown if browser doesn't support session storage
      '#unsupportedbrowser': function () {
            console.log('*************************');
    console.log('unsuportd');
    console.log('**************************');
        $('#unsupported').show();
      }
    }

    if (pagemap[action]){
      pagemap[action]();
    } else {
      // Redirect to home page
      window.location.hash = '#http://localhost/test_test_tes/index.php/jeu/';
    }
  }

  function setActiveNav(navId) {
        console.log('*************************');
    console.log('setactivenav');
    console.log('**************************');
    $('#navbar').find('li').removeClass('active');
    $(navId).addClass('active');
  }


function renderNav(isAuthed) {
      console.log('*************************');
    console.log('renderNav');
    console.log('**************************');
  if (isAuthed) {
    $('.authed-nav').show();
  } else {
    $('.authed-nav').hide();
  }
}
function renderTokens() {
      console.log('*************************');
    console.log('render token');
    console.log('**************************');
  if (sessionStorage.accessToken) {
      console.log('*************************');
    console.log('render token 1');
    console.log('**************************');
    // For demo purposes display the token and expiration
    var expireDate = new Date(parseInt(sessionStorage.tokenExpires));
    $('#token', window.parent.document).text(sessionStorage.accessToken);
    $('#expires-display', window.parent.document).text(expireDate.toLocaleDateString() + ' ' + expireDate.toLocaleTimeString());
    if (sessionStorage.idToken) {
        console.log('*************************');
    console.log('render token 2');
    console.log('**************************');
      $('#id-token', window.parent.document).text(sessionStorage.idToken);
    }
    $('#token-display', window.parent.document).show();
  } else {
      console.log('*************************');
    console.log('render token 3');
    console.log('**************************');
    $('#token-display', window.parent.document).hide();
  }
}
function renderError(error, description) {
      console.log('*************************');
    console.log('rendererror');
    console.log('**************************');
  $('#error-name', window.parent.document).text('An error occurred: ' + decodePlusEscaped(error));
  $('#error-desc', window.parent.document).text(decodePlusEscaped(description));
  $('#error-display', window.parent.document).show();
}
  function renderWelcome(isAuthed) {
        console.log('*************************');
    console.log('renderwelcome');
    console.log('**************************');
    if (isAuthed) {
      $('#username').text(sessionStorage.userDisplayName);
      $('#logged-in-welcome').show();
      setActiveNav('#home-nav');
    } else {
      $('#connect-button').attr('href', buildAuthUrl());
      $('#signin-prompt').show();
    }
  }
function renderInbox() {
      console.log('*************************');
    console.log('renderinbox');
    console.log('**************************');
  setActiveNav('#inbox-nav');
  $('#inbox-status').text('Loading...');
  $('#message-list').empty();
  $('#inbox').show();
  // Get user's email address
  getUserEmailAddress(function(userEmail, error) {
    if (error) {
      renderError('getUserEmailAddress failed', error.responseText);
    } else {
      getUserInboxMessages(userEmail, function(messages, error){
  if (error) {
  renderError('getUserInboxMessages failed', error);
} else {
  $('#inbox-status').text('Here are the 10 most recent messages in your inbox.');
  var templateSource = $('#msg-list-template').html();
  var template = Handlebars.compile(templateSource);

  var msgList = template({messages: messages});
  $('#message-list').append(msgList);
}
});
    }
  });
}
  // OAUTH FUNCTIONS =============================
function buildAuthUrl() {
      console.log('*************************');
    console.log('buildauthurl');
    console.log('**************************');
  // Generate random values for state and nonce
  sessionStorage.authState = guid();
  sessionStorage.authNonce = guid();

  var authParams = {
      
      
    response_type: 'id_token token',
    client_id: appId,
    redirect_uri: redirectUri,
    scope: scopes,
    state: sessionStorage.authState,
    nonce: sessionStorage.authNonce,
    response_mode: 'fragment'
  };

  return authEndpoint + $.param(authParams);
}

function handleTokenResponse(hash) {
      console.log('*************************');
    console.log('handletokenresponse');
    console.log('**************************');
    // If this was a silent request remove the iframe
$('#auth-iframe').remove();
  // clear tokens
  sessionStorage.removeItem('accessToken');
  sessionStorage.removeItem('idToken');

  var tokenresponse = parseHashParams(hash);

  // Check that state is what we sent in sign in request
  if (tokenresponse.state != sessionStorage.authState) {
    sessionStorage.removeItem('authState');
    sessionStorage.removeItem('authNonce');
    // Report error
    window.location.hash = '#error=Invalid+state&error_description=The+state+in+the+authorization+response+did+not+match+the+expected+value.+Please+try+signing+in+again.';
    return;
  }

  sessionStorage.authState = '';
  sessionStorage.accessToken = tokenresponse.access_token;

  // Get the number of seconds the token is valid for,
  // Subract 5 minutes (300 sec) to account for differences in clock settings
  // Convert to milliseconds
  var expiresin = (parseInt(tokenresponse.expires_in) - 300) * 1000;
  var now = new Date();
  var expireDate = new Date(now.getTime() + expiresin);
  sessionStorage.tokenExpires = expireDate.getTime();

  sessionStorage.idToken = tokenresponse.id_token;

  // Redirect to home page
  validateIdToken(function(isValid) {
  if (isValid) {
    // Re-render token to handle refresh
    renderTokens();

    // Redirect to home page
    window.location.hash = '#http://localhost/test_test_tes/index.php/jeu/';
  } else {
    clearUserState();
    // Report error
    window.location.hash = '#error=Invalid+ID+token&error_description=ID+token+failed+validation,+please+try+signing+in+again.';
  }
});   
}

function validateIdToken(callback) {
      console.log('*************************');
    console.log('validateidtoken');
    console.log('**************************');
  // Per Azure docs (and OpenID spec), we MUST validate
  // the ID token before using it. However, full validation
  // of the signature currently requires a server-side component
  // to fetch the public signing keys from Azure. This sample will
  // skip that part (technically violating the OpenID spec) and do
  // minimal validation

  if (null == sessionStorage.idToken || sessionStorage.idToken.length <= 0) {
    callback(false);
  }

  // JWT is in three parts seperated by '.'
  var tokenParts = sessionStorage.idToken.split('.');
  if (tokenParts.length != 3){
    callback(false);
  }

  // Parse the token parts
  var header = KJUR.jws.JWS.readSafeJSONString(b64utoutf8(tokenParts[0]));
  var payload = KJUR.jws.JWS.readSafeJSONString(b64utoutf8(tokenParts[1]));

  // Check the nonce
  if (payload.nonce != sessionStorage.authNonce) {
    sessionStorage.authNonce = '';
    callback(false);
  }

  sessionStorage.authNonce = '';

  // Check the audience
  if (payload.aud != appId) {
    callback(false);
  }

  // Check the issuer
  // Should be https://login.microsoftonline.com/{tenantid}/v2.0
  if (payload.iss !== 'https://login.microsoftonline.com/' + payload.tid + '/v2.0') {
    callback(false);
  }

  // Check the valid dates
  var now = new Date();
  // To allow for slight inconsistencies in system clocks, adjust by 5 minutes
  var notBefore = new Date((payload.nbf - 300) * 1000);
  var expires = new Date((payload.exp + 300) * 1000);
  if (now < notBefore || now > expires) {
    callback(false);
  }

  // Now that we've passed our checks, save the bits of data
  // we need from the token.

  sessionStorage.userDisplayName = payload.name;
  sessionStorage.userSigninName = payload.preferred_username;

  // Per the docs at:
  // https://azure.microsoft.com/en-us/documentation/articles/active-directory-v2-protocols-implicit/#send-the-sign-in-request
  // Check if this is a consumer account so we can set domain_hint properly
  sessionStorage.userDomainType = 
    payload.tid === '9188040d-6c67-4c5b-b112-36a304b66dad' ? 'consumers' : 'organizations';

  callback(true);
}
function makeSilentTokenRequest(callback) {
      console.log('*************************');
    console.log('makesilenttokenrequest');
    console.log('**************************');
  // Build up a hidden iframe
  var iframe = $('<iframe/>');
  iframe.attr('id', 'auth-iframe');
  iframe.attr('name', 'auth-iframe');
  iframe.appendTo('body');
  iframe.hide();

  iframe.load(function() {
    callback(sessionStorage.accessToken);
  });

  iframe.attr('src', buildAuthUrl() + '&prompt=none&domain_hint=' + 
    sessionStorage.userDomainType + '&login_hint=' + 
    sessionStorage.userSigninName);
}
// Helper method to validate token and refresh
// if needed
function getAccessToken(callback) {
      console.log('*************************');
    console.log('getaccesstoken');
    console.log('**************************');
  var now = new Date().getTime();
  var isExpired = now > parseInt(sessionStorage.tokenExpires);
  // Do we have a token already?
  if (sessionStorage.accessToken && !isExpired) {
    // Just return what we have
    if (callback) {
      callback(sessionStorage.accessToken);
    }
  } else {
    // Attempt to do a hidden iframe request
    makeSilentTokenRequest(callback);
  }
}
  // OUTLOOK API FUNCTIONS =======================
function getUserEmailAddress(callback) {
      console.log('*************************');
    console.log('getuseremailadress');
    console.log('**************************');
  if (sessionStorage.userEmail) {
    callback(sessionStorage.userEmail);
  } else {
    getAccessToken(function(accessToken) {
      if (accessToken) {
        // Create a Graph client
        var client = MicrosoftGraph.Client.init({
          authProvider: (done) => {
            // Just return the token
            done(null, accessToken);
          }
        });

        // Get the Graph /Me endpoint to get user email address
        client
          .api('/me')
          .get((err, res) => {
            if (err) {
              callback(null, err);
            } else {
              callback(res.mail);
            }
          });
      } else {
        var error = { responseText: 'Could not retrieve access token' };
        callback(null, error);
      }
    });
  }
}
function getUserInboxMessages(emailAddress, callback) {
      console.log('*************************');
    console.log('getuserInboxMessages');
    console.log('**************************');
  getAccessToken(function(accessToken) {
    if (accessToken) {
      // Create a Graph client
      var client = MicrosoftGraph.Client.init({
        authProvider: (done) => {
          // Just return the token
          done(null, accessToken);
        }
      });

      // Get the 10 newest messages
      client
        .api('/me/mailfolders/inbox/messages')
        .header('X-AnchorMailbox', emailAddress)
        .top(5)
        .select('subject,from,receivedDateTime,bodyPreview,uniqueBody')
        .orderby('receivedDateTime DESC')
        .get((err, res) => {
          if (err) {
            callback(null, err);
          } else {
            callback(res.value);
          }
        });
    } else {
      var error = { responseText: 'Could not retrieve access token' };
      callback(null, error);
    }
  });
}
  // HELPER FUNCTIONS ============================
function guid() {
      console.log('*************************');
    console.log('guid');
    console.log('**************************');
  var buf = new Uint16Array(8);
  cryptObj.getRandomValues(buf);
  function s4(num) {
    var ret = num.toString(16);
    while (ret.length < 4) {
      ret = '0' + ret;
    }
    return ret;
  }
  return s4(buf[0]) + s4(buf[1]) + '-' + s4(buf[2]) + '-' + s4(buf[3]) + '-' +
    s4(buf[4]) + '-' + s4(buf[5]) + s4(buf[6]) + s4(buf[7]);
}

function parseHashParams(hash) {
      console.log('*************************');
    console.log('parsehashparams');
    console.log('**************************');
  var params = hash.slice(1).split('&');

  var paramarray = {};
  params.forEach(function(param) {
    param = param.split('=');
    paramarray[param[0]] = param[1];
  });

  return paramarray;
}
function decodePlusEscaped(value) {
      console.log('*************************');
    console.log('decodeplusescaped');
    console.log('**************************');
  // decodeURIComponent doesn't handle spaces escaped
  // as '+'
  if (value) {
    return decodeURIComponent(value.replace(/\+/g, ' '));
  } else {
    return '';
  }
}
function clearUserState() {
      console.log('*************************');
    console.log('clearuserstate');
    console.log('**************************');
  // Clear session
  sessionStorage.clear();
}
Handlebars.registerHelper("formatDate", function(datetime){
  // Dates from API look like:
  // 2016-06-27T14:06:13Z

  var date = new Date(datetime);
  return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
});

});


