//Click sur icone plus ajout d'une entreprise
$(document).on('click','.insert i',function()
{
 var cible = $(this).data('cible');
 var style = $(cible).css('display');
 if(style == 'none')
 {
  $(cible).css('display','block');
  $('.insert').html('<i class="fa fa-minus" data-cible="'+cible+'"></i>');
 }
 else
 {
  $(cible).css('display','none');
  $('.insert').html('<i class="fa fa-plus" data-cible="'+cible+'"></i>');
 }
});

//Click sur icone stylo modification de l'entreprise
$(document).on('click','.form_enterprise i.fa-pencil',function()
{
 var key = $(this).data('key');
 $('.form_enterprise[data-key='+key+']').submit();
});

//Click sur icone croix suppression de l'entreprise
$(document).on('click','.form_enterprise i.fa-remove',function()
{
 var key = $(this).data('key');
 if(confirm('Supprimer cette entreprise ?'))
 {
  $('.delete_enterprise[data-key='+key+']').submit();
 }
});
