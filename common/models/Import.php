<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "import".
 *
 * @property integer $Id_PersonRequest
 * @property integer $Id_PersonRequestSeasons
 * @property string $PersonCodeU
 * @property string $UniversitySpecialitiesKode
 * @property string $NameRequestSeason
 * @property integer $RequestPerPerson
 * @property integer $Id_UniversitySpecialities
 * @property string $UniversitySpecialitiesDateBegin
 * @property string $UniversitySpecialitiesDateEnd
 * @property string $UniversityKode
 * @property string $UniversityFullName
 * @property string $UniversityShortName
 * @property string $UniversityFacultetKode
 * @property string $UniversityFacultetFullName
 * @property string $UniversityFacultetShortName
 * @property string $SpecCode
 * @property integer $SpecClasifierCode
 * @property string $SpecIndastryName
 * @property string $SpecDirectionName
 * @property string $SpecSpecialityName
 * @property integer $Id_Language
 * @property string $SpecScecializationCode
 * @property string $SpecScecializationName
 * @property integer $OriginalDocumentsAdd
 * @property integer $Id_PersonRequestStatus
 * @property integer $Id_PersonRequestStatusType
 * @property string $PersonRequestStatusCode
 * @property integer $Id_PersonRequestStatusTypeName
 * @property string $PersonRequestStatusTypeName
 * @property string $Descryption
 * @property integer $IsNeedHostel
 * @property string $CodeOfBusiness
 * @property integer $Id_PersonEnteranceTypes
 * @property string $PersonEnteranceTypeName
 * @property integer $Id_PersonRequestExaminationCause
 * @property string $PersonRequestExaminationCauseName
 * @property integer $IsContract
 * @property integer $IsBudget
 * @property integer $Id_PersonEducationForm
 * @property string $PersonEducationFormName
 * @property string $KonkursValue
 * @property string $KonkursValueSource
 * @property integer $PriorityRequest
 * @property string $KonkursValueCorrectValue
 * @property string $KonkursValueCorrectValueDescription
 * @property integer $Id_PersonRequestSeasonDetails
 * @property integer $Id_Qualification
 * @property string $QualificationName
 * @property integer $Id_PersonDocumentType
 * @property string $PersonDocumentTypeName
 * @property integer $Id_PersonDocument
 * @property string $EntrantDocumentSeries
 * @property string $EntrantDocumentNumbers
 * @property string $EntrantDocumentDateGet
 * @property string $EntrantDocumentIssued
 * @property string $EntrantDocumentValue
 * @property integer $IsCheckForPaperCopy
 * @property integer $IsNotCheckAttestat
 * @property integer $IsForeinghEntrantDocumet
 * @property integer $RequestEnteranseCodes
 * @property integer $Id_UniversityEntrantWave
 * @property integer $RequestStatusIsBudejt
 * @property integer $RequestStatusIsContract
 * @property integer $UniversityEntrantWaveName
 * @property integer $IsHigherEducation
 * @property integer $SkipDocumentValue
 * @property integer $Id_PersonDocumentsAwardType
 * @property string $PersonDocumentsAwardTypeName
 * @property integer $Id_OrderOfEnrollment
 * @property integer $SpecSpecialityClasifierCode
 * @property integer $Id_PersonName
 * @property string $FIO
 * @property string $BU
 */
class Import extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'import';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_PersonRequest', 'Id_PersonRequestSeasons', 'RequestPerPerson', 'Id_UniversitySpecialities', 'SpecClasifierCode', 'Id_Language', 'OriginalDocumentsAdd', 'Id_PersonRequestStatus', 'Id_PersonRequestStatusType', 'Id_PersonRequestStatusTypeName', 'IsNeedHostel', 'Id_PersonEnteranceTypes', 'Id_PersonRequestExaminationCause', 'IsContract', 'IsBudget', 'Id_PersonEducationForm', 'PriorityRequest', 'Id_PersonRequestSeasonDetails', 'Id_Qualification', 'Id_PersonDocumentType', 'Id_PersonDocument', 'IsCheckForPaperCopy', 'IsNotCheckAttestat', 'IsForeinghEntrantDocumet', 'RequestEnteranseCodes', 'Id_UniversityEntrantWave', 'RequestStatusIsBudejt', 'RequestStatusIsContract', 'UniversityEntrantWaveName', 'IsHigherEducation', 'SkipDocumentValue', 'Id_PersonDocumentsAwardType', 'Id_OrderOfEnrollment', 'SpecSpecialityClasifierCode', 'Id_PersonName'], 'integer'],
            [['KonkursValue', 'KonkursValueCorrectValue'], 'number'],
            [['PersonCodeU', 'UniversitySpecialitiesKode', 'UniversityKode', 'UniversityFacultetKode', 'SpecCode', 'SpecScecializationCode'], 'string', 'max' => 36],
            [['NameRequestSeason', 'KonkursValueSource', 'EntrantDocumentValue'], 'string', 'max' => 45],
            [['UniversitySpecialitiesDateBegin', 'UniversitySpecialitiesDateEnd', 'EntrantDocumentDateGet'], 'string', 'max' => 19],
            [['UniversityFullName'], 'string', 'max' => 100],
            [['UniversityShortName'], 'string', 'max' => 12],
            [['UniversityFacultetFullName'], 'string', 'max' => 93],
            [['UniversityFacultetShortName', 'PersonRequestStatusCode', 'Descryption', 'PersonEducationFormName', 'KonkursValueCorrectValueDescription'], 'string', 'max' => 10],
            [['SpecIndastryName', 'PersonRequestExaminationCauseName'], 'string', 'max' => 57],
            [['SpecDirectionName', 'SpecSpecialityName'], 'string', 'max' => 85],
            [['SpecScecializationName'], 'string', 'max' => 98],
            [['PersonRequestStatusTypeName'], 'string', 'max' => 17],
            [['CodeOfBusiness'], 'string', 'max' => 11],
            [['PersonEnteranceTypeName'], 'string', 'max' => 44],
            [['QualificationName'], 'string', 'max' => 150],
            [['PersonDocumentTypeName'], 'string', 'max' => 77],
            [['EntrantDocumentSeries'], 'string', 'max' => 8],
            [['EntrantDocumentNumbers'], 'string', 'max' => 9],
            [['EntrantDocumentIssued'], 'string', 'max' => 470],
            [['PersonDocumentsAwardTypeName'], 'string', 'max' => 25],
            [['FIO'], 'string', 'max' => 95],
            [['BU'], 'string', 'max' => 46],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_PersonRequest' => 'Id  Person Request',
            'Id_PersonRequestSeasons' => 'Id  Person Request Seasons',
            'PersonCodeU' => 'Person Code U',
            'UniversitySpecialitiesKode' => 'University Specialities Kode',
            'NameRequestSeason' => 'Name Request Season',
            'RequestPerPerson' => 'Request Per Person',
            'Id_UniversitySpecialities' => 'Id  University Specialities',
            'UniversitySpecialitiesDateBegin' => 'University Specialities Date Begin',
            'UniversitySpecialitiesDateEnd' => 'University Specialities Date End',
            'UniversityKode' => 'University Kode',
            'UniversityFullName' => 'University Full Name',
            'UniversityShortName' => 'University Short Name',
            'UniversityFacultetKode' => 'University Facultet Kode',
            'UniversityFacultetFullName' => 'University Facultet Full Name',
            'UniversityFacultetShortName' => 'University Facultet Short Name',
            'SpecCode' => 'Spec Code',
            'SpecClasifierCode' => 'Spec Clasifier Code',
            'SpecIndastryName' => 'Spec Indastry Name',
            'SpecDirectionName' => 'Spec Direction Name',
            'SpecSpecialityName' => 'Spec Speciality Name',
            'Id_Language' => 'Id  Language',
            'SpecScecializationCode' => 'Spec Scecialization Code',
            'SpecScecializationName' => 'Spec Scecialization Name',
            'OriginalDocumentsAdd' => 'Original Documents Add',
            'Id_PersonRequestStatus' => 'Id  Person Request Status',
            'Id_PersonRequestStatusType' => 'Id  Person Request Status Type',
            'PersonRequestStatusCode' => 'Person Request Status Code',
            'Id_PersonRequestStatusTypeName' => 'Id  Person Request Status Type Name',
            'PersonRequestStatusTypeName' => 'Person Request Status Type Name',
            'Descryption' => 'Descryption',
            'IsNeedHostel' => 'Is Need Hostel',
            'CodeOfBusiness' => 'Code Of Business',
            'Id_PersonEnteranceTypes' => 'Id  Person Enterance Types',
            'PersonEnteranceTypeName' => 'Person Enterance Type Name',
            'Id_PersonRequestExaminationCause' => 'Id  Person Request Examination Cause',
            'PersonRequestExaminationCauseName' => 'Person Request Examination Cause Name',
            'IsContract' => 'Is Contract',
            'IsBudget' => 'Is Budget',
            'Id_PersonEducationForm' => 'Id  Person Education Form',
            'PersonEducationFormName' => 'Person Education Form Name',
            'KonkursValue' => 'Konkurs Value',
            'KonkursValueSource' => 'Konkurs Value Source',
            'PriorityRequest' => 'Priority Request',
            'KonkursValueCorrectValue' => 'Konkurs Value Correct Value',
            'KonkursValueCorrectValueDescription' => 'Konkurs Value Correct Value Description',
            'Id_PersonRequestSeasonDetails' => 'Id  Person Request Season Details',
            'Id_Qualification' => 'Id  Qualification',
            'QualificationName' => 'Qualification Name',
            'Id_PersonDocumentType' => 'Id  Person Document Type',
            'PersonDocumentTypeName' => 'Person Document Type Name',
            'Id_PersonDocument' => 'Id  Person Document',
            'EntrantDocumentSeries' => 'Entrant Document Series',
            'EntrantDocumentNumbers' => 'Entrant Document Numbers',
            'EntrantDocumentDateGet' => 'Entrant Document Date Get',
            'EntrantDocumentIssued' => 'Entrant Document Issued',
            'EntrantDocumentValue' => 'Entrant Document Value',
            'IsCheckForPaperCopy' => 'Is Check For Paper Copy',
            'IsNotCheckAttestat' => 'Is Not Check Attestat',
            'IsForeinghEntrantDocumet' => 'Is Foreingh Entrant Documet',
            'RequestEnteranseCodes' => 'Request Enteranse Codes',
            'Id_UniversityEntrantWave' => 'Id  University Entrant Wave',
            'RequestStatusIsBudejt' => 'Request Status Is Budejt',
            'RequestStatusIsContract' => 'Request Status Is Contract',
            'UniversityEntrantWaveName' => 'University Entrant Wave Name',
            'IsHigherEducation' => 'Is Higher Education',
            'SkipDocumentValue' => 'Skip Document Value',
            'Id_PersonDocumentsAwardType' => 'Id  Person Documents Award Type',
            'PersonDocumentsAwardTypeName' => 'Person Documents Award Type Name',
            'Id_OrderOfEnrollment' => 'Id  Order Of Enrollment',
            'SpecSpecialityClasifierCode' => 'Spec Speciality Clasifier Code',
            'Id_PersonName' => 'Id  Person Name',
            'FIO' => 'Fio',
            'BU' => 'Bu',
        ];
    }
}
