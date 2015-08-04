<?php /* Smarty version 2.6.28, created on 2015-08-04 04:59:30
         compiled from db:catalog_admin_type_category_form.html */ ?>
<div>
    <form name="<?php echo $this->_tpl_vars['form']['name']; ?>
" id="<?php echo $this->_tpl_vars['form']['name']; ?>
" action="<?php echo $this->_tpl_vars['form']['action']; ?>
" method="<?php echo $this->_tpl_vars['form']['method']; ?>
" <?php echo $this->_tpl_vars['form']['extra']; ?>
>
        <table class="outer" width="100%">
                <tr class="head">
                    <th colspan="2"><?php echo $this->_tpl_vars['form']['title']; ?>
</th>
                </tr>
                <?php if (count($this->_tpl_vars['form']['elements'])):
    foreach ($this->_tpl_vars['form']['elements'] as $this->_tpl_vars['item']):
 ?>
                <?php if (! $this->_tpl_vars['item']['hidden']): ?>
                <tr>
                <td class="even"><?php echo $this->_tpl_vars['item']['caption']; ?>
<?php if ($this->_tpl_vars['item']['required']): ?><em>*</em><?php endif; ?></td>
                <td class="odd"><?php echo $this->_tpl_vars['item']['body']; ?>
</td>
                </tr>
                <?php else: ?>
                    <?php echo $this->_tpl_vars['item']['body']; ?>

                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </table>
    </form>
</div>
<?php echo $this->_tpl_vars['form']['javascript']; ?>
