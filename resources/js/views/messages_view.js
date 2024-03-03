Library.MessagesView = Backbone.View.extend({
    el: '#view_container', // Set the element where the view will be rendered
    bootstrapOptions: {
        bg: 'bg-primary',
        text:  'text-white',
        border: 'border-primary',
        title: 'Notice',
        alert: 'alert alert-primary'
    },
    events: {
        // 'change #shelf_number_dropdown': 'render',

    },
    initialize: function (options) {
        this.type = options.type;
        this.level = options.level;
        this.message = options.message;

        // Initialize any variables or setup logic here
        this.render();
    },
    render: function () {
        var options = this.options,
            self = this;
        switch (this.level) {
            case 'error':
            case 'danger': self.bootstrapName = 'danger'; self.bootstrapText ="light"; self.bootstrapOptions.title = "There was an Error"; break;
            case 'warning': self.bootstrapName = 'warning'; self.bootstrapText ="dark"; self.bootstrapOptions.title = "Warning Notice"; break;
            case 'success':
            case 'status': self.bootstrapName = 'success'; self.bootstrapText ="light"; self.bootstrapOptions.title = "Action was successful"; break;
            case 'info': self.bootstrapName = 'info'; self.bootstrapText ="dark"; self.bootstrapOptions.title = "For Your Information"; break;
            case 'primary':
            default: self.bootstrapName = 'primary'; self.bootstrapText ="light"; self.bootstrapOptions.title = "Notice"; break;
        }
        self.bootstrapOptions.alert = 'alert alert-' + self.bootstrapName;
        self.bootstrapOptions.bg = 'bg-' + self.bootstrapName;
        self.bootstrapOptions.textcolor = 'text-' + self.bootstrapText;
        self.bootstrapOptions.border = 'border-' + self.bootstrapName;

        switch (this.type) {
            case 'toast': self.renderToast(); break;
            case 'alert': self.renderAlert(); break;
            case 'modal': self.renderModal(); break;
            default: self.renderToast(); break;
        }
    },
    renderToast: function () {
        var self = this;
        var toast =
            '<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">' +
                ' <div id="liveToast" class="toast '+ self.bootstrapOptions.bg + ' ' + self.bootstrapOptions.border +' border-2" role="alert" aria-live="assertive" aria-atomic="true">' +
                    '<div class="toast-header ' + self.bootstrapOptions.border +' ">' +
                        '<span class="fw-bold">'+self.bootstrapOptions.title+'</span>' +
                    '</div>' +
                    '<div class="toast-body fw-bold '+self.bootstrapOptions.textcolor+'">' +
                      self.message +
                    '</div>' +
                '</div>' +
            '</div>';
        if ($('.toast-container').length > 0) {
            $('.toast-container').remove();
        }
        this.$el.append(toast)
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            // Customize autohide and other options if needed
            return new bootstrap.Toast(toastEl, { autohide: true }).show();
        });
    },
    renderAlert: function () {
        var self = this;
        var alert =
            '<div id="alertMessage">' +
            '<div class="alert alert-'+ self.bootstrapName +' alert-dismissible fade show ' + self.bootstrapOptions.border + ' " role="alert">' +
            '<span class="fw-bold">'+self.bootstrapOptions.title+'</span>&nbsp;&nbsp;' +
            '<span>' + self.message + '</span>' +
            '</div>'+
        '</div>';
        if ($('#alertMessage').length > 0) {
            $('#alertMessage').remove();
        }
        $('#alert-container').append(alert);
        setTimeout(function() {
            $('#alertMessage').alert('close'); // Using Bootstrap's alert method to close the alert smoothly
        }, 3500); // 4000 milliseconds = 4 seconds
    },

    renderModal: function () {
        var self = this;
        var modal =
            '<div class="modal fade" id="viewMessage" tabindex="-1" aria-labelledby="viewMessage" aria-hidden="true">' +
                ' <div class="modal-dialog  ' + self.bootstrapOptions.border + '  ' + self.bootstrapOptions.bg + ' ">' +
                   '<div class="modal-content border-0 bg-' + self.bootstrapOptions.bg + ' ">' +
                        '<div class="modal-header border-0 ' + self.bootstrapOptions.alert +' ">' +
                            '<h1 class="modal-title fs-5">'+self.bootstrapOptions.title+'</h1>' +
                        '</div>' +
                        '<div class="modal-body border-0' + self.bootstrapOptions.bg + ' ">' +
                            self.message +
                        '</div>' +
                        '<div class="modal-footer border-0">' +
                            '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>';
        if ($('#viewMessage').length > 0) {
            $('#viewMessage').remove();
        }
        this.$el.append(modal);
        options = {}
    var messageModal = new bootstrap.Modal('#viewMessage', options);
    messageModal.show();
    }
});
