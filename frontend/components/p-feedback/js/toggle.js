(function ($) {
    "use strict";

    $.widget("lssoft.lssoftFeedbackToggle", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            urls: {
                modal: 'lssoft/feedback/modal'
            }
        },

        /**
         * Конструктор
         *
         * @constructor
         * @private
         */
        _create: function () {
            this._super();

            this._on({click: '_onClick'});
        },

        /**
         *
         */
        _onClick: function (event) {
            event.preventDefault();
            this.showModal();
        },

        /**
         *
         */
        showModal: function () {
            ls.modal.load(this.option('urls.modal'), this.option('params'), {
                aftershow: function (event, data) {
                    this._initModal(data.element);
                }.bind(this)
            });
        },

        /**
         *
         */
        _initModal: function (modal) {
            modal.lssoftFeedbackModal({
                params: this.option('params')
            });
        }
    });
})(jQuery);