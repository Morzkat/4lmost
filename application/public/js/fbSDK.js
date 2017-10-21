function statusChangeCallback(response)
  {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected')
    {
      testAPI();
    } else
    {
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  function checkLoginState()
  {
    FB.getLoginStatus(function(response)
    {
      statusChangeCallback(response);
      console.log('logged');
    });
  }

function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);

    });
  }

  function shareWithFacebook(id_meme)
  {
    FB.ui({

      method: 'share',

      mobile_iframe: true,

      href: 'http://uvalabasofia.tk/memeInfo?id_meme= '+ id_meme +'',

    }, function(response){console.log(response);});
  }
