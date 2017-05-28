<?php
namespace Transformatika\Message;

class MessageConstant
{
    const ERR_EMPTY = 'Please enter {name}';
    const ERR_PASSWORD = 'Password does not match';
    const ERR_NOT_FOUND = '{name} not found';
    const ERR_VALIDATE_EMAIL = 'Invalid email address';
    const ERR_VALIDATE_COMMON = 'Invalid {name}';
    const ERR_DB_CONNECTION = 'Cant connect to database server';
    const ERR_DB_QUERY = 'Failed while trying to execute your query script';
    const ERR_DB_EXECUTE = 'Failed while trying to execute your query script';
    const ERR_DB_UPDATE = 'Failed while updating database record';
    const ERR_DB_INSERT = 'Failed while storing data into database';
    const ERR_DB_SAVE = 'Failed while saving data into database';
    const ERR_DB_DELETE = 'Failed while deleting records from database';
    const ERR_DB_RECORD_EXISTS = 'Record {name} already exist';
    const ERR_FILE_EXISTS = 'File {name} already exists';
    const ERR_FILE_DELETE = 'Failed while deleting file: {name}';
    const ERR_FILE_CREATE = 'Failed creating file: {name}';
    const ERR_FILE_NOT_FOUND = 'File: {name} does not exists';
    const ERR_EXISTS = '{name} already exists';
    const ERR_ACCOUNT_NOT_ACTIVE = 'Your Account: {name} is not active';
    const ERR_ACCOUNT_NOT_FOUND = 'Account: {name} not found';
    const ERR_ACCOUNT_EXPIRED = 'Account: {name} has expired since {date}';
    const ERR_ACCOUNT_BLOCKED = 'Your Account: {name} cant be used at this time with reason: {reason}';
    const ERR_ACCOUNT_DEV = 'Developer Option is not active.';
    const ERR_SEND_MAIL = 'Email can\'t be sent right now. please try again later';

    const SUCCESS_DB_SAVE = 'Records has been successfully saved';
    const SUCCESS_DB_UPDATE = 'Records has been updated';
    const SUCCESS_DB_INSERT = 'New Record has been created';
    const SUCCESS_DB_DELETE = 'Record deleted';
    const SUCCESS_FILE_CREATE = 'File: {name} successfully created';
    const SUCCESS_FILE_DELETE = 'File: {name} successfully deleted';

    const ACCOUNT_ACTIVATED = 'Your Account: {name} successfully activated';
    const ACCOUNT_EXPIRED = 'Account: {name} has expired since {date}';
    const ACCOUNT_NOT_ACTIVE = 'Your Account: {name} is not active';
    const ACCOUNT_PASSWORD_CHANGED = 'Password successfully changed';
}
