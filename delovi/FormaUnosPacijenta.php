
<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE DESNO pocinje ovde ------------------------------>
    
<h1 class="form-header-pacijent">Унос пацијента</h1>

<form ACTION="Logicki/AkcijaSnimiPacijenta.php" METHOD="POST">

<div class="form-container-pacijent">


<div class="input-container">
    <label for="BrojIstorijeBolesti"> Број историје болести<span aria-label="required">*</span></label>
    <input type="text" name="BrojIstorijeBolesti" required>
</div>

<div class="input-container">
    <label for="JMBG">ЈМБГ<span aria-label="required">*</span></label>
    <input type="text" name="JMBG" required>
</div>
            
<div class="input-container">
    <label for="Ime">Име<span aria-label="required">*</span></label>
    <input type="text" name="Ime" required>
</div>   


<div class="input-container">
    <label for="Prezime">Презиме:<span aria-label="required">*</span></label>
    <input type="text" name="Prezime" required>
</div>   

<div class="input-container">
    <label for="ImeJednogRoditelja">Име једног родитеља<span aria-label="required">*</span></label>
    <input type="text" name="ImeJednogRoditelja" required>
</div>

<div class="input-container">
    <label for="LBO">ЛБО<span aria-label="required">*</span></label>
    <input type="text" name="LBO" required>
</div>


<div class="input-container">
    <label for="OsnovOsiguranja">Основ осигурања<span aria-label="required">*</span></label>
    <input type="text" name="OsnovOsiguranja" required>
</div>   

<div class="input-container">
    <label for="ClanJePorodice">Члан је породице<span aria-label="required">*</span></label>
    <input type="text" name="ClanJePorodice" required>
</div>   


<div class="input-container">
    <label for="Telefon">Телефон:<span aria-label="required">*</span></label>
    <input type="text" name="Telefon" required>
</div>   

<div class="input-container">
    <label for="DatumRodjenja">Датум рођења:<span aria-label="required">*</span></label>
    <input type="text" name="DatumRodjenja" required>
</div>   


<div class="input-container">
    <label for="Odeljenje">Одељење:<span aria-label="required">*</span></label>
    <input type="text" name="Odeljenje" required>
</div>   

<div id="save-btn">
    <button type="submit" class="save-btn" name="btnSnimiVozilo" value="Сними">Сними</button>
</div>
</div>
</form>
            