{capture 'email_content'}
    {$oUser=$oFeedback->getUser()}
    Пользователь
    {if $oUser}
        <a href="{$oUser->getUserWebPath()}">{$oFeedback->getUserNameDisplay()} ({$oFeedback->getUserMailDisplay()})</a>
    {else}
        {$oFeedback->getUserNameDisplay()} ({$oFeedback->getUserMailDisplay()})
    {/if}
    написал обращение:<br/>
    <blockquote>{$oFeedback->getText()|nl2br}</blockquote>
{/capture}

{component 'email' content=$smarty.capture.email_content}