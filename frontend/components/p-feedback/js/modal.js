/**
 * @copyright 2016 OOO "ЛС-СОФТ" {@link http://livestreetcms.com}
 * @author    Denis Shakhov <denis.shakhov@gmail.com>
 */

(function ($) {
    "use strict";

    $.widget("lssoft.lssoftFeedbackModal", $.livestreet.lsComponent, {
        /**
         * Дефолтные опции
         */
        options: {
            // Ссылки
            urls: {
                submit: 'lssoft/feedback/submit'
            },

            // Селекторы
            selectors: {
                form: '#lssoft-feedback-form',
                validate: '.js-form-validate'
            }
        },

        /**
         * Конструктор
         */
        _create: function () {
            this._super();

            this.elements.validate.parsley();
            this._on(this.elements.form, {submit: '_onFormSubmit'});
        },

        /**
         *
         */
        _onFormSubmit: function (event) {
            event.preventDefault();
            this._submit('submit', this.elements.form, '_onFormSubmitSuccess');
        },

        /**
         *
         */
        _onFormSubmitSuccess: function () {
            this.element.lsModal('hide');
        }
    });
})(jQuery);