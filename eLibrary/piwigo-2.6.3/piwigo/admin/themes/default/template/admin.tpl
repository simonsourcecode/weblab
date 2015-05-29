{combine_script id='jquery.ui.accordion' load='header'}{*we load in the header because the accordion is on every admin page and usually all admin pages use the same header combined script but not the same footer script*}
{footer_script require='jquery.ui.accordion'}
jQuery(document).ready(function(){ldelim}
	jQuery('#menubar').accordion({ldelim}
		header: "dt.rdion",
		event: "click",
		heightStyle: "content",
		active: {$ACTIVE_MENU}
	});
});
{/footer_script}

<div id="menubar">
  <div id="adminHome"><a href="{$U_ADMIN}">{'Administration Home'|@translate}</a></div>
	<dl class="first">
		<dt class="rdion"><span class="icon-picture"> </span><span>{'Photos'|@translate}&nbsp;</span></dt>
		<dd>
			<ul>
				<li><a class="icon-plus-circled" href="{$U_ADD_PHOTOS}">{'Add'|@translate}</a></li>
				<li><a class="icon-star" href="{$U_RATING}">{'Rating'|@translate}</a></li>
				<li><a class="icon-tags" href="{$U_TAGS}">{'Tags'|@translate}</a></li>
				<li><a class="icon-clock" href="{$U_RECENT_SET}">{'Recent photos'|@translate}</a></li>
				<li><a class="icon-pencil" href="{$U_BATCH}">{'Batch Manager'|@translate}</a></li>
{if $NB_PHOTOS_IN_CADDIE > 0}
				<li><a class="icon-flag" href="{$U_CADDIE}">{'Caddie'|@translate}<span class="adminMenubarCounter">{$NB_PHOTOS_IN_CADDIE}</span></a></li>
{/if}
			</ul>
		</dd>
	</dl>
	<dl>
		<dt class="rdion"><span class="icon-sitemap"> </span><span>{'Albums'|@translate}&nbsp;</span></dt>
    <dd>
      <ul>
        <li><a class="icon-folder-open" href="{$U_CATEGORIES}">{'Manage'|@translate}</a></li>
        <li><a class="icon-pencil" href="{$U_CAT_OPTIONS}">{'Properties'|@translate}</a></li>
      </ul>
    </dd>
	</dl>
	<dl>
		<dt class="rdion"><span class="icon-users"> </span><span>{'Users'|@translate}&nbsp;</span></dt>
		<dd>
      <ul>
        <li><a class="icon-user-add" href="{$U_USERS}">{'Manage'|@translate}</a></li>
        <li><a class="icon-group" href="{$U_GROUPS}">{'Groups'|@translate}</a></li>
				<li><a class="icon-mail-1" href="{$U_NOTIFICATION_BY_MAIL}">{'Notification'|@translate}</a></li>
      </ul>
		</dd>
	</dl>
	<dl>
		<dt class="rdion"><span class="icon-puzzle"> </span><span>{'Plugins'|@translate}&nbsp;</span></dt>
		<dd>
      <ul>
        <li><a class="icon-equalizer" href="{$U_PLUGINS}">{'Manage'|@translate}</a></li>
      </ul>
      <div id="pluginsMenuSeparator"></div>
{if !empty($plugin_menu_items)}
      <ul class="scroll">
  {foreach from=$plugin_menu_items item=menu_item}
        <li><a href="{$menu_item.URL}">{$menu_item.NAME}</a></li>
  {/foreach}
      </ul>
{/if}
		</dd>
	</dl>
	<dl>
		<dt class="rdion"><span class="icon-wrench"> </span><span>{'Tools'|@translate}&nbsp;</span></dt>
		<dd>
      <ul>
{if $ENABLE_SYNCHRONIZATION}
        <li><a class="icon-exchange" href="{$U_CAT_UPDATE}">{'Synchronize'|@translate}</a></li>
        <li><a class="icon-flow-branch" href="{$U_SITE_MANAGER}">{'Site manager'|@translate}</a></li>
{/if}
				<li><a class="icon-signal" href="{$U_HISTORY_STAT}">{'History'|@translate}</a></li>
				<li><a class="icon-tools" href="{$U_MAINTENANCE}">{'Maintenance'|@translate}</a></li>
{if isset($U_COMMENTS)}
				<li><a class="icon-chat" href="{$U_COMMENTS}">{'Comments'|@translate}{if $NB_PENDING_COMMENTS > 0}<span class="adminMenubarCounter" title="{'%d waiting for validation'|translate:$NB_PENDING_COMMENTS}">{$NB_PENDING_COMMENTS}</span>{/if}</a></li>
{/if}
        <li><a class="icon-arrows-cw" href="{$U_UPDATES}">{'Updates'|@translate}</a></li>
      </ul>
		</dd>
	</dl>
	<dl class="last">
		<dt class="rdion"><span class="icon-cog"> </span><span>{'Configuration'|@translate}&nbsp;</span></dt>
		<dd>
      <ul>
        <li><a class="icon-cog-alt" href="{$U_CONFIG_GENERAL}">{'Options'|@translate}</a></li>
        <li><a class="icon-menu" href="{$U_CONFIG_MENUBAR}">{'Menu Management'|@translate}</a></li>
        <li><a class="icon-code" href="{$U_CONFIG_EXTENTS}">{'Templates'|@translate}</a></li>
				<li><a class="icon-language" href="{$U_CONFIG_LANGUAGES}">{'Languages'|@translate}</a></li>
        <li><a class="icon-brush" href="{$U_CONFIG_THEMES}">{'Themes'|@translate}</a></li>
      </ul>
    </dd>
  </dl>
</div> <!-- menubar -->

<div id="content" class="content">

  {if isset($TABSHEET)}
  {$TABSHEET}
  {/if}
  {if isset($U_HELP)}
	{combine_script id='core.scripts' load='async' path='themes/default/js/scripts.js'}
  <ul class="HelpActions">
    <li><a href="{$U_HELP}" onclick="popuphelp(this.href); return false;" title="{'Help'|@translate}"><img src="{$ROOT_URL}{$themeconf.admin_icon_dir}/help.png" alt="(?)"></a></li>
  </ul>
  {/if}

  {if isset($errors)}
  <div class="errors">
    <ul>
      {foreach from=$errors item=error}
      <li>{$error}</li>
      {/foreach}
    </ul>
  </div>
  {/if}

  {if isset($infos)}
  <div class="infos">
    <ul>
      {foreach from=$infos item=info}
      <li>{$info}</li>
      {/foreach}
    </ul>
  </div>
  {/if}

  {if isset($warnings)}
  <div class="warnings">
    <ul>
      {foreach from=$warnings item=warning}
      <li>{$warning}</li>
      {/foreach}
    </ul>
  </div>
  {/if}

  {$ADMIN_CONTENT}
</div>
