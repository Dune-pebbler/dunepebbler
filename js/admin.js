let targetId = 'acf-group_6225e21b694ed';

jQuery(document).ready(function () {
    onPrepareFields();
    onRepeaterListeners();
    //onGlobalListeners();
})

function onPrepareFields() {
    // we loop through every section type
    jQuery('[data-name=type_section]').each(function () {
        let element = jQuery(this);
        let container = element.parents('tr.acf-row');
        let containerIndex = container.index();

        container.addClass('is-changeable');

        // if we have the first one, add active state.
        if (containerIndex == 0) {
            setRepeaterActiveState(container);
            return;
        }

        setRepeaterInactiveState(container);
    });
}

function onGlobalListeners() {
    jQuery(document).on('click', function (e) {

        if (jQuery(e.target).parents('.is-changeable').length > 0) return;
        if (jQuery(e.target).parents('.mce-container').length > 0) return;
        
        setRepeaterInactiveState(jQuery('.is-changeable'));
    })
}

function onRepeaterListeners() {
    jQuery('[data-name="sections"]').on('click', '.is-changeable', function () {
        let container = jQuery(this);

        // set the old one to inactive
        setRepeaterInactiveState(jQuery('.is-changeable.is-active'));

        // set new one to active
        setRepeaterActiveState(container);
    });
}

function setRepeaterActiveState(container) {
    container.removeClass('is-inactive');
    container.addClass('is-active');
}

function setRepeaterInactiveState(container) {
    container.removeClass('is-active');
    container.addClass('is-inactive');
}