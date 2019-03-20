<ul class="rights">
    <li><label><input type="checkbox" name="000401" <?php if(in_array('000401',$this->get('_rights_num'))) echo "checked"; ?> /> Dostep do modułu nawigacja</label></li>
    <ul>
        <li><label><input type="checkbox" name="000402" <?php if(in_array('000402',$this->get('_rights_num'))) echo "checked"; ?> /> Widok listy linków nawigacyjnych</label></li>
        <li><label><input type="checkbox" name="000403" <?php if(in_array('000403',$this->get('_rights_num'))) echo "checked"; ?> /> Dodawanie nowych linków</label></li>
        <li><label><input type="checkbox" name="000404" <?php if(in_array('000404',$this->get('_rights_num'))) echo "checked"; ?> /> Edycja linków nawigacyjnych</label></li>
        <ul>
            <li><label><input type="checkbox" name="000405" <?php if(in_array('000405',$this->get('_rights_num'))) echo "checked"; ?> /> Usuwanie linków nawigacyjnych</label></li>
        </ul>
    </ul>
</ul>