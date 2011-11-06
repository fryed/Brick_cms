{if $messages.messages}
<div class="messageBox">
	<p>{$messages.messages}</p>
</div>
{/if}

{if $messages.errors}
<div class="errorBox">
	{$messages.errors}
</div>
{/if}