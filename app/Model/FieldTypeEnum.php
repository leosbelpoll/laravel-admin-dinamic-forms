<?php

namespace App\Model;

abstract class FieldTypeEnum
{
    const NUMBER = 'NUMBER';
    const SHORT_TEXT = 'SHORT_TEXT';
    const LONG_TEXT = 'LONG_TEXT';
    const SELECT = 'SELECT';
    const IMAGE = 'IMAGE';
    const CHECK_OPTIONS = 'CHECK_OPTIONS';
    const CHECK_OPTIONS_SI_NO_OTRO = 'CHECK_OPTIONS_SI_NO_OTRO';
    const DATE = 'DATE';
}