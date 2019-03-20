<ul class="rights">
    <li><label><input type="checkbox" name="000601" <?php if(in_array('000601',$this->get('_rights_num'))) echo "checked"; ?> /> Dostep do modułu CRM</label></li>
    <ul>
        <li><label><input type="checkbox" name="000602" <?php if(in_array('000602',$this->get('_rights_num'))) echo "checked"; ?> /> Widok listy klientów</label></li>
        <li><label><input type="checkbox" name="000603" <?php if(in_array('000603',$this->get('_rights_num'))) echo "checked"; ?> /> Wyszukiwanie klientów</label></li>
        <li><label><input type="checkbox" name="000604" <?php if(in_array('000604',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja nowego klienta</label></li>
        <li><label><input type="checkbox" name="000605" <?php if(in_array('000605',$this->get('_rights_num'))) echo "checked"; ?> /> Widok szczegółowy klienta</label></li>
        <ul>
            <li><label><input type="checkbox" name="000606" <?php if(in_array('000606',$this->get('_rights_num'))) echo "checked"; ?> /> Edycja klienta</label></li>
            <li><label><input type="checkbox" name="000607" <?php if(in_array('000607',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja nowego kontaktu do klienta</label></li>
            <li><label><input type="checkbox" name="000608" <?php if(in_array('000608',$this->get('_rights_num'))) echo "checked"; ?> /> Edycja kontaktu do klienta</label></li>
            <ul>
                <li><label><input type="checkbox" name="000609" <?php if(in_array('000609',$this->get('_rights_num'))) echo "checked"; ?> /> Usuwanie kontaktu do klienta</label></li>
            </ul>
            <li><label><input type="checkbox" name="000610" <?php if(in_array('000610',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja nowej budowy klienta</label></li>
            <li><label><input type="checkbox" name="000611" <?php if(in_array('000611',$this->get('_rights_num'))) echo "checked"; ?> /> Edycja budowy klienta</label></li>
            <ul>
                <li><label><input type="checkbox" name="000612" <?php if(in_array('000612',$this->get('_rights_num'))) echo "checked"; ?> /> Usuwanie budowy klienta</label></li>
            </ul>
            <li><label><input type="checkbox" name="000613" <?php if(in_array('000613',$this->get('_rights_num'))) echo "checked"; ?> /> Widok archiwum klientów</label></li>
        </ul>
    </ul>
</ul>