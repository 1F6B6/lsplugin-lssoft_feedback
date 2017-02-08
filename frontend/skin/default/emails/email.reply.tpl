{capture 'email_content'}
    {$oFeedback->getTextReply()|nl2br}

    <br/>
    <br/>
    <b>Ваше обращение от {date_format date=$oFeedback->getDateCreate()}</b>:
    <blockquote>{$oFeedback->getText()|nl2br}</blockquote>
{/capture}

{component 'email' content=$smarty.capture.email_content}