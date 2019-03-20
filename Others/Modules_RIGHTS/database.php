<ul class="rights">
    <li><label><input type="checkbox" name="000301" <?php if(in_array('000301',$this->get('_rights_num'))) echo "checked"; ?> /> Dostep do modułu bazy danych</label></li>
    <ul>
        <li><label><input type="checkbox" name="000302" <?php if(in_array('000302',$this->get('_rights_num'))) echo "checked"; ?> /> Widok listy zrzutów bazy danych</label></li>
        <li><label><input type="checkbox" name="000303" <?php if(in_array('000303',$this->get('_rights_num'))) echo "checked"; ?> /> Tworzenie zrzutów bazy danych</label></li>
        <li><label><input type="checkbox" name="000304" <?php if(in_array('000304',$this->get('_rights_num'))) echo "checked"; ?> /> Przywracanie zrzutów bazy danych</label></li>
    </ul>
</ul>