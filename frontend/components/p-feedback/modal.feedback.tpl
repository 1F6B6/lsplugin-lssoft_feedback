{capture 'invite_modal_to_admin'}
    <form class="js-form-validate" action="" method="post" id="lssoft-feedback-form">

        {if !$oUserCurrent}
            {* Имя *}
            {component 'field' template='text'
                name='name'
                rules=[ 'required' => true, 'rangetags' => '[1,200]' ]
                label={lang 'plugin.lssoft_feedback.field.name.label'}}

            {* Электронная почта *}
            {component 'field' template='email'
                name='mail'
                rules=[ 'required' => true ]}
        {/if}

        {* Ваше сообщение *}
        {component 'field' template='textarea'
            mods='textarea'
            name='text'
            rows=5
            rules=[ 'required' => true, 'rangetags' => '[1,2000]' ]
            placeholder={lang 'plugin.lssoft_feedback.field.text.label'}}
    </form>
{/capture}

{component 'modal'
    classes='js-modal-default'
    id='lssoft-feedback-modal'
    title={lang 'plugin.lssoft_feedback.modal.title'}
    rules=[ 'required' => true ]
    content=$smarty.capture.invite_modal_to_admin
    primaryButton=[
        'form' => 'lssoft-feedback-form',
        'text' => {lang 'common.send'}
    ]}