
{include file='include/dbselect.inc.tpl'}

<table class="doubleSelect">
  <tr>
    <td>
      <h3>{$L_CAT_OPTIONS_TRUE}</h3>
      <select class="categoryList" name="cat_true[]" multiple="multiple" size="30">
        {html_options options=$category_option_true selected=$category_option_true_selected}
      </select>
      <p><input class="submit" type="submit" value="&raquo;" name="falsify" style="font-size:15px;"></p>
    </td>

    <td>
      <h3>{$L_CAT_OPTIONS_FALSE}</h3>
      <select class="categoryList" name="cat_false[]" multiple="multiple" size="30">
        {html_options options=$category_option_false selected=$category_option_false_selected}
      </select>
      <p><input class="submit" type="submit" value="&laquo;" name="trueify" style="font-size:15px;"></p>
    </td>
  </tr>
</table>
