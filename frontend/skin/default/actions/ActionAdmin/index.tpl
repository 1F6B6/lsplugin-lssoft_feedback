{if $items}
    <table class="ls-table">
        <thead>
        <tr>
            <th width="10" class="text-center">ID</th>
            <th width="200"">Пользователь</th>
            <th>Сообщение</th>
            <th width="150" class="text-center">Дата</th>
            <th width="150" class="text-center">Ответ</th>
            <th width="10"></th>
        </tr>
        </thead>

        <tbody>
        {foreach $items as $item}
            <tr id="lssoft-feedback-item-{$item->getId()}">
                <td class="text-center">{$item->getId()}</td>
                <td>
                    {$oUser=$item->getUser()}
                    {if $oUser}
                        <a href="{$oUser->getUserWebPath()}">{$item->getUserNameDisplay()}</a>
                    {else}
                        {$item->getUserNameDisplay()}
                    {/if}
                    <br/>
                    <i>{$item->getUserMailDisplay()}</i>
                </td>
                <td>
                    {$item->getText()|truncate:500:'...'|nl2br}
                </td>
                <td class="text-center">{date_format date=$item->getDateCreate() format="d F Y, H:i"}</td>
                <td class="text-center">
                    <a href="#" class="fa fa-commenting" title="Ответить" data-toggle="tooltip" style="color: {if $item->getDateReply()}#27b166{else}#c5c5c5{/if}"
                       data-type="modal-toggle"
                       data-param-id="{$item->getId()}"
                       data-modal-aftershow="ls.plugin.lssoft.feedback.initFormAnswer()"
                       data-modal-url="{$oAdminUrl->get('ajax/modal/answer')}"></a>
                    {if $item->getDateReply()}
                        <br/>
                        {date_format date=$item->getDateReply()}
                    {/if}
                </td>
                <td class="ls-ta-r">
                    <a href="#" class="fa fa-trash-o js-lssoft-feedback-admin-remove js-confirm-remove-" data-toggle="tooltip" data-id="{$item->getId()}" title="Удалить"></a>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
{else}
    {component 'admin:blankslate' text='Нет обращений'}
{/if}

{component 'admin:pagination' total=+$aPaging.iCountPage current=+$aPaging.iCurrentPage url="{$aPaging.sBaseUrl}/page__page__/{$aPaging.sGetParams}"}