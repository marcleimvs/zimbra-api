<?php

namespace Zimbra\Tests\Voice;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Enum\VoiceMsgActionOp;
use Zimbra\Enum\VoiceSortBy;

/**
 * Testcase class for mail request.
 */
class RequestTest extends ZimbraTestCase
{
    public function testChangeUCPassword()
    {
        $req = new \Zimbra\Voice\Request\ChangeUCPassword(
            'password'
        );
        $this->assertSame('password', $req->password());
        $req->password('password');
        $this->assertSame('password', $req->password());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ChangeUCPasswordRequest password="password" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ChangeUCPasswordRequest' => array(
                'password' =>'password',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetUCInfo()
    {
        $req = new \Zimbra\Voice\Request\GetUCInfo();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetUCInfoRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetUCInfoRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVoiceFeatures()
    {
        $pref = new \Zimbra\Voice\Struct\VoiceMailPrefName('name');
        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsReq(
            array($pref)
        );
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionReq();
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingReq();
        $callforward = new \Zimbra\Voice\Struct\CallForwardReq();
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineReq();
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerReq();
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingReq();
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardReq();
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceReq();
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionReq();

        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $phone = new \Zimbra\Voice\Struct\PhoneVoiceFeaturesSpec(
            'name',
            $voicemailprefs,
            $anoncallrejection,
            $calleridblocking,
            $callforward,
            $callforwardbusyline,
            $callforwardnoanswer,
            $callwaiting,
            $selectivecallforward,
            $selectivecallacceptance,
            $selectivecallrejection
        );

        $req = new \Zimbra\Voice\Request\GetVoiceFeatures(
            $storeprincipal, $phone
        );
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());
        $req->storeprincipal($storeprincipal)
            ->phone($phone);
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetVoiceFeaturesRequest>'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                .'<phone name="name">'
                    .'<voicemailprefs>'
                        .'<pref name="name" />'
                    .'</voicemailprefs>'
                    .'<anoncallrejection />'
                    .'<calleridblocking />'
                    .'<callforward />'
                    .'<callforwardbusyline />'
                    .'<callforwardnoanswer />'
                    .'<callwaiting />'
                    .'<selectivecallforward />'
                    .'<selectivecallacceptance />'
                    .'<selectivecallrejection />'
                .'</phone>'
            .'</GetVoiceFeaturesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetVoiceFeaturesRequest' => array(
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
                'phone' => array(
                    'name' => 'name',
                    'voicemailprefs' => array(
                        'pref' => array(
                            array(
                                'name' => 'name',
                            ),
                        ),
                    ),
                    'anoncallrejection' => array(),
                    'calleridblocking' => array(),
                    'callforward' => array(),
                    'callforwardbusyline' => array(),
                    'callforwardnoanswer' => array(),
                    'callwaiting' => array(),
                    'selectivecallforward' => array(),
                    'selectivecallacceptance' => array(),
                    'selectivecallrejection' => array(),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVoiceFolder()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $pref = new \Zimbra\Voice\Struct\PrefSpec('name');
        $phone = new \Zimbra\Voice\Struct\PhoneSpec('name', array($pref));

        $req = new \Zimbra\Voice\Request\GetVoiceFolder(
            $storeprincipal, array($phone)
        );
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame(array($phone), $req->phone()->all());
        $req->storeprincipal($storeprincipal)
            ->addPhone($phone);
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame(array($phone, $phone), $req->phone()->all());
        $req->phone()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetVoiceFolderRequest>'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                .'<phone name="name">'
                    .'<pref name="name" />'
                .'</phone>'
            .'</GetVoiceFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetVoiceFolderRequest' => array(
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
                'phone' => array(
                    array(
                        'name' => 'name',
                        'pref' => array(
                            array(
                                'name' => 'name',
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVoiceInfo()
    {
        $pref = new \Zimbra\Voice\Struct\PrefSpec('name');
        $phone = new \Zimbra\Voice\Struct\PhoneSpec('name', array($pref));

        $req = new \Zimbra\Voice\Request\GetVoiceInfo(
            array($phone)
        );
        $this->assertSame(array($phone), $req->phone()->all());
        $req->addPhone($phone);
        $this->assertSame(array($phone, $phone), $req->phone()->all());
        $req->phone()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetVoiceInfoRequest>'
                .'<phone name="name">'
                    .'<pref name="name" />'
                .'</phone>'
            .'</GetVoiceInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetVoiceInfoRequest' => array(
                'phone' => array(
                    array(
                        'name' => 'name',
                        'pref' => array(
                            array(
                                'name' => 'name',
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVoiceMailPrefs()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $pref = new \Zimbra\Voice\Struct\PrefSpec('name');
        $phone = new \Zimbra\Voice\Struct\PhoneSpec('name', array($pref));

        $req = new \Zimbra\Voice\Request\GetVoiceMailPrefs(
            $storeprincipal, $phone
        );
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());
        $req->storeprincipal($storeprincipal)
            ->phone($phone);
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetVoiceMailPrefsRequest>'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                .'<phone name="name">'
                    .'<pref name="name" />'
                .'</phone>'
            .'</GetVoiceMailPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetVoiceMailPrefsRequest' => array(
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
                'phone' => array(
                    'name' => 'name',
                    'pref' => array(
                        array(
                            'name' => 'name',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyFromNum()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $phone = new \Zimbra\Voice\Struct\ModifyFromNumSpec(
            'oldPhone', 'phone', 'id', 'label'
        );

        $req = new \Zimbra\Voice\Request\ModifyFromNum(
            $storeprincipal, $phone
        );
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());
        $req->storeprincipal($storeprincipal)
            ->phone($phone);
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyFromNumRequest>'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                .'<phone oldPhone="oldPhone" phone="phone" id="id" label="label" />'
            .'</ModifyFromNumRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyFromNumRequest' => array(
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
                'phone' => array(
                    'oldPhone' => 'oldPhone',
                    'phone' => 'phone',
                    'id' => 'id',
                    'label' => 'label',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVoiceFeatures()
    {
        $pref = new \Zimbra\Voice\Struct\PrefInfo('name', 'value');
        $phone = new \Zimbra\Voice\Struct\CallerListEntry('pn', true);
        $voicemailprefs = new \Zimbra\Voice\Struct\VoiceMailPrefsFeature(
            true, false, array($pref)
        );
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionFeature(
            true, false
        );
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingFeature(
            true, false
        );
        $callforward = new \Zimbra\Voice\Struct\CallForwardFeature(
            true, false, 'ft'
        );
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineFeature(
            true, false, 'ft'
        );
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerFeature(
            true, false, 'ft', 'nr'
        );
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingFeature(
            true, false
        );
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardFeature(
            true, false, array($phone), 'ft'
        );
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceFeature(
            true, false, array($phone)
        );
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionFeature(
            true, false, array($phone)
        );

        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $phone = new \Zimbra\Voice\Struct\ModifyVoiceFeaturesSpec(
            'name',
            $voicemailprefs,
            $anoncallrejection,
            $calleridblocking,
            $callforward,
            $callforwardbusyline,
            $callforwardnoanswer,
            $callwaiting,
            $selectivecallforward,
            $selectivecallacceptance,
            $selectivecallrejection
        );

        $req = new \Zimbra\Voice\Request\ModifyVoiceFeatures(
            $storeprincipal, $phone
        );
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());
        $req->storeprincipal($storeprincipal)
            ->phone($phone);
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyVoiceFeaturesRequest>'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                .'<phone name="name">'
                    .'<voicemailprefs s="1" a="0">'
                        .'<pref name="name">value</pref>'
                    .'</voicemailprefs>'
                    .'<anoncallrejection s="1" a="0" />'
                    .'<calleridblocking s="1" a="0" />'
                    .'<callforward s="1" a="0" ft="ft" />'
                    .'<callforwardbusyline s="1" a="0" ft="ft" />'
                    .'<callforwardnoanswer s="1" a="0" ft="ft" nr="nr" />'
                    .'<callwaiting s="1" a="0" />'
                    .'<selectivecallforward s="1" a="0" ft="ft">'
                        .'<phone pn="pn" a="1" />'
                    .'</selectivecallforward>'
                    .'<selectivecallacceptance s="1" a="0">'
                        .'<phone pn="pn" a="1" />'
                    .'</selectivecallacceptance>'
                    .'<selectivecallrejection s="1" a="0">'
                        .'<phone pn="pn" a="1" />'
                    .'</selectivecallrejection>'
                .'</phone>'
            .'</ModifyVoiceFeaturesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyVoiceFeaturesRequest' => array(
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
                'phone' => array(
                    'name' => 'name',
                    'voicemailprefs' => array(
                        's' => 1,
                        'a' => 0,
                        'pref' => array(
                            array(
                                'name' => 'name',
                                '_' => 'value',
                            ),
                        ),
                    ),
                    'anoncallrejection' => array(
                        's' => 1,
                        'a' => 0,
                    ),
                    'calleridblocking' => array(
                        's' => 1,
                        'a' => 0,
                    ),
                    'callforward' => array(
                        's' => 1,
                        'a' => 0,
                        'ft' => 'ft',
                    ),
                    'callforwardbusyline' => array(
                        's' => 1,
                        'a' => 0,
                        'ft' => 'ft',
                    ),
                    'callforwardnoanswer' => array(
                        's' => 1,
                        'a' => 0,
                        'ft' => 'ft',
                        'nr' => 'nr',
                    ),
                    'callwaiting' => array(
                        's' => 1,
                        'a' => 0,
                    ),
                    'selectivecallforward' => array(
                        's' => 1,
                        'a' => 0,
                        'ft' => 'ft',
                        'phone' => array(
                            array(
                                'pn' => 'pn',
                                'a' => 1,
                            ),
                        ),
                    ),
                    'selectivecallacceptance' => array(
                        's' => 1,
                        'a' => 0,
                        'phone' => array(
                            array(
                                'pn' => 'pn',
                                'a' => 1,
                            ),
                        ),
                    ),
                    'selectivecallrejection' => array(
                        's' => 1,
                        'a' => 0,
                        'phone' => array(
                            array(
                                'pn' => 'pn',
                                'a' => 1,
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVoiceMailPin()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $phone = new \Zimbra\Voice\Struct\ModifyVoiceMailPinSpec(
            'oldPin', 'pin', 'name'
        );

        $req = new \Zimbra\Voice\Request\ModifyVoiceMailPin(
            $storeprincipal, $phone
        );
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());
        $req->storeprincipal($storeprincipal)
            ->phone($phone);
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyVoiceMailPinRequest>'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                .'<phone oldPin="oldPin" pin="pin" name="name" />'
            .'</ModifyVoiceMailPinRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyVoiceMailPinRequest' => array(
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
                'phone' => array(
                    'oldPin' => 'oldPin',
                    'pin' => 'pin',
                    'name' => 'name',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVoiceMailPrefs()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $pref = new \Zimbra\Voice\Struct\PrefInfo('name', 'value');
        $phone = new \Zimbra\Voice\Struct\PhoneInfo('name', array($pref));

        $req = new \Zimbra\Voice\Request\ModifyVoiceMailPrefs(
            $storeprincipal, $phone
        );
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());
        $req->storeprincipal($storeprincipal)
            ->phone($phone);
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyVoiceMailPrefsRequest>'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                .'<phone name="name">'
                    .'<pref name="name">value</pref>'
                .'</phone>'
            .'</ModifyVoiceMailPrefsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyVoiceMailPrefsRequest' => array(
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
                'phone' => array(
                    'name' => 'name',
                    'pref' => array(
                        array(
                            'name' => 'name',
                            '_' => 'value',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testResetVoiceFeatures()
    {
        $anoncallrejection = new \Zimbra\Voice\Struct\AnonCallRejectionReq();
        $calleridblocking = new \Zimbra\Voice\Struct\CallerIdBlockingReq();
        $callforward = new \Zimbra\Voice\Struct\CallForwardReq();
        $callforwardbusyline = new \Zimbra\Voice\Struct\CallForwardBusyLineReq();
        $callforwardnoanswer = new \Zimbra\Voice\Struct\CallForwardNoAnswerReq();
        $callwaiting = new \Zimbra\Voice\Struct\CallWaitingReq();
        $selectivecallforward = new \Zimbra\Voice\Struct\SelectiveCallForwardReq();
        $selectivecallacceptance = new \Zimbra\Voice\Struct\SelectiveCallAcceptanceReq();
        $selectivecallrejection = new \Zimbra\Voice\Struct\SelectiveCallRejectionReq();

        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $phone = new \Zimbra\Voice\Struct\ResetPhoneVoiceFeaturesSpec(
            'name',
            $anoncallrejection,
            $calleridblocking,
            $callforward,
            $callforwardbusyline,
            $callforwardnoanswer,
            $callwaiting,
            $selectivecallforward,
            $selectivecallacceptance,
            $selectivecallrejection
        );

        $req = new \Zimbra\Voice\Request\ResetVoiceFeatures(
            $storeprincipal, $phone
        );
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());
        $req->storeprincipal($storeprincipal)
            ->phone($phone);
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($phone, $req->phone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ResetVoiceFeaturesRequest>'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                .'<phone name="name">'
                    .'<anoncallrejection />'
                    .'<calleridblocking />'
                    .'<callforward />'
                    .'<callforwardbusyline />'
                    .'<callforwardnoanswer />'
                    .'<callwaiting />'
                    .'<selectivecallforward />'
                    .'<selectivecallacceptance />'
                    .'<selectivecallrejection />'
                .'</phone>'
            .'</ResetVoiceFeaturesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ResetVoiceFeaturesRequest' => array(
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
                'phone' => array(
                    'name' => 'name',
                    'anoncallrejection' => array(),
                    'calleridblocking' => array(),
                    'callforward' => array(),
                    'callforwardbusyline' => array(),
                    'callforwardnoanswer' => array(),
                    'callwaiting' => array(),
                    'selectivecallforward' => array(),
                    'selectivecallacceptance' => array(),
                    'selectivecallrejection' => array(),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchVoice()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $req = new \Zimbra\Voice\Request\SearchVoice(
            'query', $storeprincipal, 1, 1, 'types', VoiceSortBy::DATE_DESC()
        );
        $this->assertSame('query', $req->query());
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame(1, $req->limit());
        $this->assertSame(1, $req->offset());
        $this->assertSame('types', $req->types());
        $this->assertTrue($req->sortBy()->is('dateDesc'));

        $req->query('query')
            ->storeprincipal($storeprincipal)
            ->limit(1)
            ->offset(1)
            ->types('types')
            ->sortBy(VoiceSortBy::DATE_DESC());
        $this->assertSame('query', $req->query());
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame(1, $req->limit());
        $this->assertSame(1, $req->offset());
        $this->assertSame('types', $req->types());
        $this->assertTrue($req->sortBy()->is('dateDesc'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchVoiceRequest query="query" limit="1" offset="1" types="types" sortBy="dateDesc">'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
            .'</SearchVoiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchVoiceRequest' => array(
                'query' => 'query',
                'limit' => 1,
                'offset' => 1,
                'types' =>'types',
                'sortBy' =>'dateDesc',
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testUploadVoiceMail()
    {
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $vm = new \Zimbra\Voice\Struct\VoiceMsgUploadSpec(
            'id', 'phone'
        );

        $req = new \Zimbra\Voice\Request\UploadVoiceMail(
            $storeprincipal, $vm
        );
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($vm, $req->vm());
        $req->storeprincipal($storeprincipal)
            ->vm($vm);
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($vm, $req->vm());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<UploadVoiceMailRequest>'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                .'<vm id="id" phone="phone" />'
            .'</UploadVoiceMailRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'UploadVoiceMailRequest' => array(
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
                'vm' => array(
                    'id' => 'id',
                    'phone' => 'phone',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testVoiceMsgAction()
    {
        $action = new \Zimbra\Voice\Struct\VoiceMsgActionSpec(
            VoiceMsgActionOp::MOVE(), 'phone', 'id', 'l'
        );
        $storeprincipal = new \Zimbra\Voice\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );

        $req = new \Zimbra\Voice\Request\VoiceMsgAction(
            $action, $storeprincipal
        );
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($action, $req->action());
        $req->storeprincipal($storeprincipal)
            ->action($action);
        $this->assertSame($storeprincipal, $req->storeprincipal());
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<VoiceMsgActionRequest>'
                .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />'
                .'<action op="move" phone="phone" id="id" l="l" />'
            .'</VoiceMsgActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'VoiceMsgActionRequest' => array(
                'storeprincipal' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'accountNumber' => 'accountNumber',
                ),
                'action' => array(
                    'op' => 'move',
                    'phone' => 'phone',
                    'id' => 'id',
                    'l' => 'l',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }
}