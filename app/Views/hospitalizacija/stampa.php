<table style="width:100%; padding:0;" cellspacing="0" cellpadding="0" border="0">
<tr>
<td style="width:5%;"></td>
<td>
<br/>
<span style="color: darkblue; font-size: 1rem;">

<?php if ($ukupanBroj > 0): ?>
<table style="width:90%; border-collapse: collapse;" border="1">
<thead>
<tr>
    <th style="width:10%; padding: 4px;">Број историје болести</th>
    <th style="width:20%; padding: 4px;">Основни узрок хоспитализације</th>
    <th style="width:50%; padding: 4px;">Датум пријема</th>
    <th style="width:20%; padding: 4px;">Датум отпуста</th>
</tr>
</thead>
<tbody>
<?php foreach ($items as $row): ?>
<tr>
    <td style="padding: 3px;"><?= htmlspecialchars($row['brojIstorijeBolesti']) ?></td>
    <td style="padding: 3px;"><?= htmlspecialchars($row['osnovniUzrokHospitalizacije']) ?></td>
    <td style="padding: 3px;"><?= htmlspecialchars($row['datumPrijema']) ?></td>
    <td style="padding: 3px;"><?= htmlspecialchars($row['datumOtpusta']) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table><br/><br/>
<?php else: ?>
НЕМА ПОДАТАКА
<?php endif; ?>

</span>
</td>
<td style="width:5%;"></td>
</tr>
</table>
