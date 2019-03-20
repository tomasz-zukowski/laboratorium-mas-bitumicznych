<ul class="rights">
    <li><label><input type="checkbox" name="000601" <?php if(in_array('000601',$this->get('_rights_num'))) echo "checked"; ?> /> Dostep do modułu uprawnień</label></li>
    <ul>
        <li><label><input type="checkbox" name="000602" <?php if(in_array('000602',$this->get('_rights_num'))) echo "checked"; ?> /> Edycja uprawnień</label></li>
    </ul>
</ul>