<dt>{'Identification'|@translate}</dt>
<dd>
{strip}
	{if isset($USERNAME)}
	<p>{'Hello'|@translate} {$USERNAME} !</p>
	{/if}
	<ul>
	{if isset($U_REGISTER)}
	<li><a href="{$U_REGISTER}" title="{'Create a new account'|@translate}" rel="nofollow">{'Register'|@translate}</a></li>
	{/if}
	{if isset($U_LOGIN)}
	<li><a href="{$U_LOGIN}" rel="nofollow">{'Login'|@translate}</a></li>
	{/if}
	{if isset($U_LOGOUT)}
	<li><a href="{$U_LOGOUT}">{'Logout'|@translate}</a></li>
	{/if}
	{if isset($U_PROFILE)}
	<li><a href="{$U_PROFILE}" title="{'customize the appareance of the gallery'|@translate}">{'Customize'|@translate}</a></li>
	{/if}
	{if isset($U_ADMIN)}
	<li><a href="{$U_ADMIN}" title="{'available for administrators only'|@translate}">{'Administration'|@translate}</a></li>
	{/if}
	</ul>
{/strip}
	{if isset($U_LOGIN)}
{strip}
	<form method="post" action="{$U_LOGIN}" id="quickconnect">
	<fieldset>
	<legend>{'Quick connect'|@translate}</legend>
	<div>
	<label for="username">{'Username'|@translate}</label><br>
	<input type="text" name="username" id="username" value="" style="width:99%">
	</div>

	<div><label for="password">{'Password'|@translate}</label><br>
	<input type="password" name="password" id="password" style="width:99%">
	</div>

	{if $AUTHORIZE_REMEMBERING}
	<div><label for="remember_me">
	<input type="checkbox" name="remember_me" id="remember_me" value="1"> {'Auto login'|@translate}
	</label></div>
	{/if}

	<div>
	<input type="hidden" name="redirect" value="{$smarty.server.REQUEST_URI|@urlencode}">
	<input type="submit" name="login" value="{'Submit'|@translate}">
	<span class="categoryActions">
{if isset($U_REGISTER)}
		<a href="{$U_REGISTER}" title="{'Create a new account'|@translate}" class="pwg-state-default pwg-button" rel="nofollow">
			<span class="pwg-icon pwg-icon-register"> </span>
		</a>
{/if}
		<a href="{$U_LOST_PASSWORD}" title="{'Forgot your password?'|@translate}" class="pwg-state-default pwg-button">
			<span class="pwg-icon pwg-icon-lost-password"> </span>
		</a>
	</span>
	</div>

	</fieldset>
	</form>
{/strip}
	{/if}
</dd>
