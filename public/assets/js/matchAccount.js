function matchAccount(params, data) {
    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
    return data;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
    return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    //Account search ex: 12*
    if(params.term.indexOf('*') > -1){
        params.search = params.term.replace("*", ""); 
        if (data.id.startsWith(params.search)) {
        var modifiedData = $.extend({}, data, true);
        modifiedData.text += ' (matched)';

        // You can return modified objects from here
        // This includes matching the `children` how you want in nested data sets
        return modifiedData;
        }
    }
    else
    if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
    var modifiedData = $.extend({}, data, true);
    modifiedData.text += ' (matched)';

    // You can return modified objects from here
    // This includes matching the `children` how you want in nested data sets
    return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}
//Capitalize First Letter
function capitalizeFirstLetter(string) {
    // + string.slice(1);
    return string.charAt(0).toUpperCase();
}
//For Posting Key Format
function formatSelection(val) {
    if(val.id!="")
        return val.id;
    else
        return val.text
}