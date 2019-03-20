<ul class="rights">
    <li><label><input type="checkbox" name="000201" <?php if(in_array('000201',$this->get('_rights_num'))) echo "checked"; ?> /> Dostep do modułu ustawienia</label></li>
    <ul>
        <li><label><input type="checkbox" name="000202" <?php if(in_array('000202',$this->get('_rights_num'))) echo "checked"; ?> /> Ustawienia modułów</label></li>
    </ul>
</ul>