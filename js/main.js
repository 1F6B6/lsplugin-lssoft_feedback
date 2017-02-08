var ls = ls || {};
ls.plugin = ls.plugin || {};
ls.plugin.lssoft = ls.plugin.lssoft || {};

ls.plugin.lssoft.feedback = ( function ($) {

    this.init = function (options) {
        $(document).on('click', '.js-lssoft-feedback-admin-remove', function () {
            ls.ajax.load(ls.registry.get('sAdminUrl') + 'ajax/remove', {id: $(this).data('id')}, function () {
                $('#lssoft-feedback-item-' + $(this).data('id')).fadeOut(500);
            }.bind(this));
            return false;
        });
    };

    this.initFormAnswer = function () {
        ls.ajax.form(ls.registry.get('sAdminUrl') + 'ajax/reply/', '.js-lssoft-feedback-admin-reply-create-form', function (result) {
            $('#modal-lssoft-feedback-admin-reply').lsModal('hide');
        });
    };

    $(function () {
        this.init();
    }.bind(this));

    return this;
}).call(ls.plugin.lssoft.feedback || {}, jQuery);