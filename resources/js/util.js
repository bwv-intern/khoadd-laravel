import moment from 'moment';

const toLocaleDateTime = function (isoString) {
    return (new Date(isoString)).toLocaleString();
}

const getMoment = function () {
    return moment().format('MMMM Do YYYY, h:mm:ss a');
}

export {toLocaleDateTime, getMoment}
