building_cancel_btn.hide();

building_name.attr('tabindex','301');
erf.attr('tabindex','302');

building_save_btn.attr('tabindex','303');
building_cancel_btn.attr('tabindex','304');

generate_buildings.forceNumericOnly();
generate_buildings.attr('maxlength',3);
generate_buildings.attr('minlength',1);

valuation_amount.forceNumericOnly();