var selectDiv = '.selection',
select = '.select_enterprise select',
echoEnterpriseHead = '.echo_enterprise_head',
echoEnterprise = '.echo_enterprise';

//function déplaçant la liste de sélection
function move_list(arg)
{
 if(arg == 0)
 {
  show_enterprise(0);
 }
 else
 {
  $(selectDiv).animate({'top':'0','margin-top':'0'},500,
   function()
   {
    show_enterprise(arg);
   }
  );
 }
}

//function appelant le déplacement de la liste selon la selection effectuée
function get_selection(value)
{
 if( value == 0)
 {
  move_list(0);
 }
 else
 {
  move_list(value);
 }
}

function hideEnterprise(data = null)
{

 if(data == null)
 {
  $(echoEnterprise).animate({'opacity':'0','z-index':'-1'},500,function()
   {
    $(echoEnterprise).css({'display':'none'});
   }
  );
 }
 else
 {
  $(echoEnterprise).animate({'opacity':'0','z-index':'-1'},500,function()
   {
    $(echoEnterprise).css({'display':'none'});
    $(echoEnterprise+'[data-enterprise='+data+']').css({'opacity':'1','z-index':'0','display':'block'});
   }
  );
 }
}

//function show/hide des détails des entreprises
function show_enterprise(data)
{
 if(data !== 0)
 {
  $(echoEnterpriseHead).animate({'opacity':'1','z-index':'0'},500);
  hideEnterprise(data);
 }
 else
 {
  hideEnterprise();
  $(echoEnterpriseHead).animate({'opacity':'0','z-index':'-1'},500,function()
  {
   $(selectDiv).animate({'top':'50%','margin-top':'-2em'},500);
  });
 }
}
