<ul class="rights">
    <li><label><input type="checkbox" name="000701" <?php if(in_array('000701',$this->get('_rights_num'))) echo "checked"; ?> /> Dostep do modułu LAB</label></li>
    <ul>
        <li><label><input type="checkbox" name="000702" <?php if(in_array('000702',$this->get('_rights_num'))) echo "checked"; ?> /> Widok listy standardów</label></li>
        <li><label><input type="checkbox" name="000703" <?php if(in_array('000703',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja nowego standardu</label></li>
        <li><label><input type="checkbox" name="000704" <?php if(in_array('000704',$this->get('_rights_num'))) echo "checked"; ?> /> Widok szczegółowy standardu</label></li>
        <ul>
            <li><label><input type="checkbox" name="000705" <?php if(in_array('000705',$this->get('_rights_num'))) echo "checked"; ?> /> Edycja standardu</label></li>
            <li><label><input type="checkbox" name="000706" <?php if(in_array('000706',$this->get('_rights_num'))) echo "checked"; ?> /> Archiwizowanie standardu</label></li>
            <li><label><input type="checkbox" name="000707" <?php if(in_array('000707',$this->get('_rights_num'))) echo "checked"; ?> /> Zarządzanie opisami standardu</label></li>
            <ul>
                <li><label><input type="checkbox" name="000708" <?php if(in_array('000708',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja nowego opisu mieszanki</label></li>
                <li><label><input type="checkbox" name="000709" <?php if(in_array('000709',$this->get('_rights_num'))) echo "checked"; ?> /> Usuwanie opisu mieszanki</label></li>
            </ul>
            <li><label><input type="checkbox" name="000710" <?php if(in_array('000710',$this->get('_rights_num'))) echo "checked"; ?> /> Zarządzanie typami standardu</label></li>
            <ul>
                <li><label><input type="checkbox" name="000710" <?php if(in_array('000710',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja nowego typu standardu</label></li>
                <li><label><input type="checkbox" name="000711" <?php if(in_array('000711',$this->get('_rights_num'))) echo "checked"; ?> /> Usuwanie typu standardu</label></li>
            </ul>
            <li><label><input type="checkbox" name="000712" <?php if(in_array('000712',$this->get('_rights_num'))) echo "checked"; ?> /> Zarządzanie kategoriami standardu</label></li>
            <ul>
                <li><label><input type="checkbox" name="000712" <?php if(in_array('000712',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja nowej kategorii standardu</label></li>
                <li><label><input type="checkbox" name="000736" <?php if(in_array('000736',$this->get('_rights_num'))) echo "checked"; ?> /> Usuwanie kategorii standardu</label></li>
            </ul>
        </ul>
        <li><label><input type="checkbox" name="000713" <?php if(in_array('000713',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestrowanie/edycja krzywych granicznych mieszanek</label></li>
        <li><label><input type="checkbox" name="000714" <?php if(in_array('000714',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestrowanie dopuszczalnych odchyłek od krzywych granicznych</label></li>
        <ul>
            <li><label><input type="checkbox" name="000715" <?php if(in_array('000715',$this->get('_rights_num'))) echo "checked"; ?> /> Edycja dopuszczalnych odchyłek od krzywych granicznych</label></li>
        </ul>
        <li><label><input type="checkbox" name="000732" <?php if(in_array('000732',$this->get('_rights_num'))) echo "checked"; ?> /> Ustawienia laboratorium</label></li>
        <li><label><input type="checkbox" name="000716" <?php if(in_array('000716',$this->get('_rights_num'))) echo "checked"; ?> /> Lista typów badań</label></li>
        <li><label><input type="checkbox" name="000717" <?php if(in_array('000717',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestrowanie nowego typu badania</label></li>
        <li><label><input type="checkbox" name="000718" <?php if(in_array('000718',$this->get('_rights_num'))) echo "checked"; ?> /> Widok szczegółowy typu badania</label></li>
        <ul>
            <li><label><input type="checkbox" name="000719" <?php if(in_array('000719',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja krzywej uziarnienia typu badania</label></li>
            <li><label><input type="checkbox" name="000720" <?php if(in_array('000720',$this->get('_rights_num'))) echo "checked"; ?> /> Usuwanie krzywej uziarnienia typu badania</label></li>
            <li><label><input type="checkbox" name="000721" <?php if(in_array('000721',$this->get('_rights_num'))) echo "checked"; ?> /> Archiwizacja typu badania</label></li>
            <li><label><input type="checkbox" name="000733" <?php if(in_array('000733',$this->get('_rights_num'))) echo "checked"; ?> /> Lista zleconych badań</label></li>
        </ul>
        <li><label><input type="checkbox" name="000722" <?php if(in_array('000722',$this->get('_rights_num'))) echo "checked"; ?> /> Zlecanie badań</label></li>
        <ul>
            <li><label><input type="checkbox" name="000735" <?php if(in_array('000735',$this->get('_rights_num'))) echo "checked"; ?> /> Widok szczegółowy zleconego badania</label></li>
            <li><label><input type="checkbox" name="000723" <?php if(in_array('000723',$this->get('_rights_num'))) echo "checked"; ?> /> Potwierdzenie dostarczenia próbki</label></li>
            <li><label><input type="checkbox" name="000724" <?php if(in_array('000724',$this->get('_rights_num'))) echo "checked"; ?> /> Usuwanie zlecenia badania</label></li>
            <li><label><input type="checkbox" name="000725" <?php if(in_array('000725',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestracja wyników badania</label></li>
            <li><label><input type="checkbox" name="000726" <?php if(in_array('000726',$this->get('_rights_num'))) echo "checked"; ?> /> Podgląd wyników badania</label></li>
            <ul>
                <li><label><input type="checkbox" name="000727" <?php if(in_array('000727',$this->get('_rights_num'))) echo "checked"; ?> /> Rejestrowanie świadectwa badania</label></li>
            </ul>
        </ul>
        <li><label><input type="checkbox" name="000734" <?php if(in_array('000734',$this->get('_rights_num'))) echo "checked"; ?> /> Archiwum zleceń badań</label></li>
        <li><label><input type="checkbox" name="000729" <?php if(in_array('000729',$this->get('_rights_num'))) echo "checked"; ?> /> Widok listy świadectw badań</label></li>
        <ul>
            <li><label><input type="checkbox" name="000728" <?php if(in_array('000728',$this->get('_rights_num'))) echo "checked"; ?> /> Wyświetlanie świadectwa badania</label></li>
        </ul>
        <li><label><input type="checkbox" name="000730" <?php if(in_array('000730',$this->get('_rights_num'))) echo "checked"; ?> /> Widok miesięczny harmonogramu</label></li>
        <ul>
            <li><label><input type="checkbox" name="000731" <?php if(in_array('000731',$this->get('_rights_num'))) echo "checked"; ?> /> Widok dzienny harmonogramu</label></li>
        </ul>
    </ul>
</ul>