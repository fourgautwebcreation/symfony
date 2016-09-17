
// Evenement onchange sur le select des entreprises
$(document).on('change',$(select),function()
{
var val = $(select).val();
get_selection(val);
});
