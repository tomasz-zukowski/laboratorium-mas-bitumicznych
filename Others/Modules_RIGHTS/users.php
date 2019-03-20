<ul class="rights">
    <li><label><input type="checkbox" name="000001" <?php if(in_array('000001',$this->get('_rights_num'))) echo "checked"; ?> /> Dostep do modułu użytkownicy</label></li>
    <ul>
        <li><label><input type="checkbox" name="000002" <?php if(in_array('000002',$this->get('_rights_num'))) echo "checked"; ?> /> Lista użytkowników</label></li>
        <li><label><input type="checkbox" name="000003" <?php if(in_array('000003',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja nowych użytkowników</label></li>
        <li><label><input type="checkbox" name="000004" <?php if(in_array('000004',$this->get('_rights_num'))) echo "checked"; ?> /> Widok szczegółowy użytkowników</label></li>
        <ul>
            <li><label><input type="checkbox" name="000005" <?php if(in_array('000005',$this->get('_rights_num'))) echo "checked"; ?> /> Edycja użytkowników</label></li>
            <ul>
                <li><label><input type="checkbox" name="000006" <?php if(in_array('000006',$this->get('_rights_num'))) echo "checked"; ?> /> Usuwanie użytkowników</label></li>
            </ul>
        </ul>
        <li><label><input type="checkbox" name="000007" <?php if(in_array('000007',$this->get('_rights_num'))) echo "checked"; ?> /> Lista grup użytkowników</label></li>
        <li><label><input type="checkbox" name="000008" <?php if(in_array('000008',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja nowych grup użytkowników</label></li>
        <ul>
            <li><label><input type="checkbox" name="000009" <?php if(in_array('000009',$this->get('_rights_num'))) echo "checked"; ?> /> Edycja grup użytkowników</label></li>
            <ul>
                <li><label><input type="checkbox" name="000010" <?php if(in_array('000010',$this->get('_rights_num'))) echo "checked"; ?> /> Usuwanie grup użytkowników</label></li>
            </ul>
        </ul>
    </ul>
</ul>
<!-- do rozpoznawanie uprawnien -->
<input type='hidden' value='rights' name='rights' />