$("#pseudo").blur(function()
{
$("#msgbox").removeClass().addClass('messagebox').text('Check en cours...').fadeIn("slow");
$.post("../pagesCommunes/checkPatient.php" ,{ pseudo:$(this).val() } ,function(data)
{
if(data=='no')
{
$("#msgbox").fadeTo(200,0.1,function()
{
$(this).html('Ce patient n\'éxiste pas..').addClass('busy').fadeTo(900,1);
});
}
else
{
$("#msgbox").fadeTo(200,0.1,function()
{
$(this).html('Ce patient existe').addClass('dispo').fadeTo(900,1);
});
}
});
});
