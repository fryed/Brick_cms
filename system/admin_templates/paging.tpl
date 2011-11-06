<div class="paging">

	<form method="post" action="">
		
		<fieldset>
			
			<input type="submit" {if !$settings.paging.prev}disabled="disabled"{/if} name="action" value="prev"/>
			<input type="submit" {if !$settings.paging.next}disabled="disabled"{/if} name="action" value="next"/>
				
			<input type="hidden" name="limit1" value="{$settings.paging.limit1}"/>
			<input type="hidden" name="limit2" value="{$settings.paging.limit2}"/>
			
		</fieldset>
		
	</form>

</div>

<br class="clearBoth"/>
