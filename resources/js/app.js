import './bootstrap';
import _ from 'lodash';
import {toLocaleDateTime, getMoment} from './util';

window.toLocaleDateTime = toLocaleDateTime;
window.getMoment = getMoment;
window._ = _;