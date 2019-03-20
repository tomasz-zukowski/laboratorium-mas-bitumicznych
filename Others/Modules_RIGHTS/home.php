<ul class="rights">
    <li><label><input type="checkbox" name="000101" <?php if(in_array('000101',$this->get('_rights_num'))) echo "checked"; ?> /> Dostep do modułu home</label></li>
    <ul>
        <li><label><input type="checkbox" name="000102" <?php if(in_array('000102',$this->get('_rights_num'))) echo "checked"; ?> /> Strona główna aplikacji</label></li>
    </ul>
</ul>