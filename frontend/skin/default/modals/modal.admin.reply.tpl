{capture 'modal_content'}
    <form role="form" id="lssoft-feedback-admin-reply-form" class="js-lssoft-feedback-admin-reply-create-form" action="" method="post">
        <div>
            <h4 class="box-title">Текст обращения</h4>
            <div>
                <i>{$oItem->getText()}</i>
            </div>
        </div>
        <br/>
        <br/>

        {component 'admin:editor'
            name            = 'text'
            value           = {$oItem->getTextReply()|escape}
            label           = 'Текст ответа'
            inputClasses    = ''}

        <input type="hidden" name="id" value="{$oItem->getId()}">
    </form>
{/capture}

{component 'modal'
title   = "Отправка ответа на обращение №{$oItem->getId()}"
primaryButton   = [ 'type' =>'submit', 'text' => 'Отправить', 'form' => 'lssoft-feedback-admin-reply-form' ]
content = $smarty.capture.modal_content
classes = 'js-modal-default'
id      = 'modal-lssoft-feedback-admin-reply'}