$(document)
  .ready(function() {

    // fix menu when passed
    $('.masthead')
      .visibility({
        once: false,
        onBottomPassed: function() {
          $('.fixed.menu').transition('fade in');
        },
        onBottomPassedReverse: function() {
          $('.fixed.menu').transition('fade out');
        }
      });

    // create sidebar and attach to menu open
    $('.ui.sidebar')
      .sidebar('attach events', '.toc.item');

  });

new Vue({
  el: '#app',
  data () {
    return {
      message: null,
      messageType: 'positive',
      auth: [],
      loginFormSubmitLoading: false,
      passwordEmailSubmitLoading: false,
      registerUserSubmitLoading: false,
      resetPasswordSubmitLoading: false,
    }
  },
  methods: {
    closeMessage: function () {
      this.message = null;
    },
    loginFormSubmit: function () {
      this.loginFormSubmitLoading = true;
      var form = new FormData();
      form.append('email', this.auth.email);
      form.append('password', this.auth.password);
      form.append('_token', CSRF);
      axios.post(CURRENT_URL, form)
      .then((res) => {
        if (res.data.status == 'error') {
          this.message = res.data.message;
        }

        if (res.data.status == 'success') {
          window.location = res.data.message;
        }
        this.loginFormSubmitLoading = false;
      });
    },
    passwordEmailSubmit: function () {
      this.passwordEmailSubmitLoading = true;
      var form = new FormData();
      form.append('email', this.auth.email);
      form.append('_token', CSRF);
      axios.post(CURRENT_URL, form)
      .then((res) => {
        this.message = res.data.message;
        this.passwordEmailSubmitLoading = false;
      });
    },
    registerUserSubmit: function () {
      this.registerUserSubmitLoading = true;
      var form = new FormData();
      form.append('name', this.auth.name);
      form.append('email', this.auth.email);
      form.append('password', this.auth.password);
      form.append('password_confirmation', this.auth.password_confirm);
      form.append('_token', CSRF);
      axios.post(CURRENT_URL, form)
      .then((res) => {
        if (res.data.errors && res.data.errors.length) {
          this.message = res.data.message;
        } else {
          // window.location = res.data.message;
        }
      })
      .catch((e) => {
        this.message = e.response.data.message;
        this.registerUserSubmitLoading = false;
      });
    },
    resetPasswordSubmit: function (asd) {
      this.resetPasswordSubmitLoading = true;
      var form = new FormData();
      var _token2 = document.getElementById('_sec_token').value;
      form.append('name', this.auth.name);
      form.append('email', this.auth.email);
      form.append('password', this.auth.password);
      form.append('password_confirmation', this.auth.password_confirmation);
      form.append('token', _token2);
      form.append('_token', CSRF);
      axios.post(CURRENT_URL + '/' + _token2, form)
      .then((res) => {
        if (res.data.errors && res.data.errors.length) {
          this.message = res.data.message;
        } else {
          window.location = res.data.message;
        }
        this.resetPasswordSubmitLoading = false;
      })
      .catch((e) => {
        this.message = e.response.data.message;
        this.resetPasswordSubmitLoading = false;
      });
    },
  }
})
