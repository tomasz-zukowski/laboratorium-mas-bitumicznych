<ul class="rights">
    <li><label><input type="checkbox" name="000801" <?php if(in_array('000801',$this->get('_rights_num'))) echo "checked"; ?> /> Dostep do zarządzania modułami</label></li>
    <ul>
        <li><label><input type="checkbox" name="000802" <?php if(in_array('000802',$this->get('_rights_num'))) echo "checked"; ?> /> Widok listy modułów</label></li>
        <li><label><input type="checkbox" name="000802" <?php if(in_array('000802',$this->get('_rights_num'))) echo "checked"; ?> /> Zmiana statusu modułu</label></li>
        <li><label><input type="checkbox" name="000802" <?php if(in_array('000802',$this->get('_rights_num'))) echo "checked"; ?> /> Instalacja nowego modułu</label></li>
    </ul>
</ul>