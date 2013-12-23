<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;
use Zimbra\Soap\Enum\ParticipationStatus;
use Zimbra\Utils\TypedSequence;

/**
 * CalendarAttendee struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CalendarAttendee
{
    /**
     * Non-standard parameters (XPARAMs)
     * @var Sequence
     */
    private $_xparam;

    /**
     * Email address (without "MAILTO:")
     * @var string
     */
    private $_a;

    /**
     * URL - has same value as {email-address}. 
     * @var string
     */
    private $_url;

    /**
     * Friendly name - "CN" in iCalendar
     * @var string
     */
    private $_d;

    /**
     * iCalendar SENT-BY
     * @var string
     */
    private $_sentBy;

    /**
     * iCalendar DIR - Reference to a directory entry associated with the calendar user. the property.
     * @var string
     */
    private $_dir;

    /**
     * iCalendar LANGUAGE - As defined in RFC5646 * (e.g. "en-US")
     * @var string
     */
    private $_lang;

    /**
     * iCalendar CUTYPE (Calendar user type)
     * @var string
     */
    private $_cutype;

    /**
     * iCalendar ROLE
     * @var string
     */
    private $_role;

    /**
     * iCalendar PTST (Participation status).
     * Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF
     * Meanings: "NE"eds-action, "TE"ntative, "AC"cept, "DE"clined, "DG" (delegated), "CO"mpleted (todo), "IN"-process (todo), "WA"iting (custom value only for todo), "DF" (deferred; custom value only for todo)
     * @var ParticipationStatus
     */
    private $_ptst;

    /**
     * iCalendar RSVP
     * @var bool
     */
    private $_rsvp;

    /**
     * iCalendar MEMBER - The group or list membership of the calendar user
     * @var string
     */
    private $_member;

    /**
     * iCalendar DELEGATED-TO
     * @var string
     */
    private $_delTo;

    /**
     * iCalendar DELEGATED-FROM
     * @var string
     */
    private $_delFrom;

    /**
     * Constructor method for CalendarAttendee
     * @param array $xparams
     * @param string $a
     * @param string $url
     * @param string $d
     * @param string $sentBy
     * @param string $dir
     * @param string $lang
     * @param string $cutype
     * @param string $role
     * @param ParticipationStatus $ptst
     * @param bool   $rsvp
     * @param string $member
     * @param string $delTo
     * @param string $delFrom
     * @return self
     */
    public function __construct(
        array $xparams = array(),
        $a = null,
        $url = null,
        $d = null,
        $sentBy = null,
        $dir = null,
        $lang = null,
        $cutype = null,
        $role = null,
        ParticipationStatus $ptst = null,
        $rsvp = null,
        $member = null,
        $delTo = null,
        $delFrom = null)
    {
        $this->_xparam = new TypedSequence('Zimbra\Soap\Struct\XParam', $xparams);

        $this->_a = trim($a);
        $this->_url = trim($url);
        $this->_d = trim($d);
        $this->_sentBy = trim($sentBy);
        $this->_dir = trim($dir);
        $this->_lang = trim($lang);
        $this->_cutype = trim($cutype);
        $this->_role = trim($role);
        if($ptst instanceof ParticipationStatus)
        {
            $this->_ptst = $ptst;
        }
        if(null !== $rsvp)
        {
            $this->_rsvp = (bool) $rsvp;
        }
        $this->_member = trim($member);
        $this->_delTo = trim($delTo);
        $this->_delFrom = trim($delFrom);
    }

    /**
     * Add xparam
     *
     * @param  XParam $xparam
     * @return self
     */
    public function addXParam(XParam $xparam)
    {
        $this->_xparam->add($xparam);
        return $this;
    }

    /**
     * Gets xparam sequence
     *
     * @return Sequence
     */
    public function xparam()
    {
        return $this->_xparam;
    }

    /**
     * Gets or sets email address
     *
     * @param  string $a email address
     * @return string|self
     */
    public function a($a = null)
    {
        if(null === $a)
        {
            return $this->_a;
        }
        $this->_a = trim($a);
        return $this;
    }

    /**
     * Gets or sets url value
     *
     * @param  string $a url url value
     * @return string|self
     */
    public function url($url = null)
    {
        if(null === $url)
        {
            return $this->_url;
        }
        $this->_url = trim($url);
        return $this;
    }

    /**
     * Gets or sets friendly name
     *
     * @param  string $d friendly name
     * @return string|self
     */
    public function d($d = null)
    {
        if(null === $d)
        {
            return $this->_d;
        }
        $this->_d = trim($d);
        return $this;
    }

    /**
     * Gets or sets iCalendar SENT-BY
     *
     * @param  string $sentBy iCalendar SENT-BY
     * @return string|self
     */
    public function sentBy($sentBy = null)
    {
        if(null === $sentBy)
        {
            return $this->_sentBy;
        }
        $this->_sentBy = trim($sentBy);
        return $this;
    }

    /**
     * Gets or sets iCalendar DIR
     *
     * @param  string $dir iCalendar DIR
     * @return string|self
     */
    public function dir($dir = null)
    {
        if(null === $dir)
        {
            return $this->_dir;
        }
        $this->_dir = trim($dir);
        return $this;
    }

    /**
     * Gets or sets iCalendar LANGUAGE
     *
     * @param  string $lang iCalendar LANGUAGE
     * @return string|self
     */
    public function lang($lang = null)
    {
        if(null === $lang)
        {
            return $this->_lang;
        }
        $this->_lang = trim($lang);
        return $this;
    }

    /**
     * Gets or sets iCalendar CUTYPE
     *
     * @param  string $cutype iCalendar CUTYPE
     * @return string|self
     */
    public function cutype($cutype = null)
    {
        if(null === $cutype)
        {
            return $this->_cutype;
        }
        $this->_cutype = trim($cutype);
        return $this;
    }

    /**
     * Gets or sets iCalendar ROLE
     *
     * @param  string $cutype iCalendar ROLE
     * @return string|self
     */
    public function role($role = null)
    {
        if(null === $role)
        {
            return $this->_role;
        }
        $this->_role = trim($role);
        return $this;
    }

    /**
     * Gets or sets iCalendar PTST
     * Valid values: NE|AC|TE|DE|DG|CO|IN|WE|DF
     *
     * @param  ParticipationStatus $ptst
     * @return ParticipationStatus|self
     */
    public function ptst(ParticipationStatus $ptst = null)
    {
        if(null === $ptst)
        {
            return $this->_ptst;
        }
        $this->_ptst = $ptst;
        return $this;
    }

    /**
     * Gets or sets iCalendar RSVP
     *
     * @param  bool $rsvp iCalendar RSVP
     * @return bool|ZAP_Soap_Struct_CalendarAttendee
     */
    public function rsvp($rsvp = null)
    {
        if(null === $rsvp)
        {
            return $this->_rsvp;
        }
        $this->_rsvp = (bool) $rsvp;
        return $this;
    }

    /**
     * Gets or sets iCalendar MEMBER
     *
     * @param  string $member iCalendar MEMBER
     * @return string|self
     */
    public function member($member = null)
    {
        if(null === $member)
        {
            return $this->_member;
        }
        $this->_member = trim($member);
        return $this;
    }

    /**
     * Gets or sets iCalendar DELEGATED-TO
     *
     * @param  string $delTo iCalendar DELEGATED-TO
     * @return string|self
     */
    public function delTo($delTo = null)
    {
        if(null === $delTo)
        {
            return $this->_delTo;
        }
        $this->_delTo = trim($delTo);
        return $this;
    }

    /**
     * Gets or sets iCalendar DELEGATED-FROM
     *
     * @param  string $delTo iCalendar DELEGATED-FROM
     * @return string|self
     */
    public function delFrom($delFrom = null)
    {
        if(null === $delFrom)
        {
            return $this->_delFrom;
        }
        $this->_delFrom = trim($delFrom);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'at')
    {
        $name = !empty($name) ? $name : 'at';
        $arr = array();
        if(!empty($this->_a))
        {
            $arr['a'] = $this->_a;
        }
        if(!empty($this->_url))
        {
            $arr['url'] = $this->_url;
        }
        if(!empty($this->_d))
        {
            $arr['d'] = $this->_d;
        }
        if(!empty($this->_sentBy))
        {
            $arr['sentBy'] = $this->_sentBy;
        }
        if(!empty($this->_dir))
        {
            $arr['dir'] = $this->_dir;
        }
        if(!empty($this->_lang))
        {
            $arr['lang'] = $this->_lang;
        }
        if(!empty($this->_cutype))
        {
            $arr['cutype'] = $this->_cutype;
        }
        if(!empty($this->_role))
        {
            $arr['role'] = $this->_role;
        }
        if($this->_ptst instanceof ParticipationStatus)
        {
            $arr['ptst'] = (string) $this->_ptst;
        }
        if(is_bool($this->_rsvp))
        {
            $arr['rsvp'] = $this->_rsvp ? 1 : 0;
        }
        if(!empty($this->_member))
        {
            $arr['member'] = $this->_member;
        }
        if(!empty($this->_delTo))
        {
            $arr['delTo'] = $this->_delTo;
        }
        if(!empty($this->_delFrom))
        {
            $arr['delFrom'] = $this->_delFrom;
        }
        if(count($this->_xparam))
        {
            $arr['xparam'] = array();
            foreach ($this->_xparam as $xparam)
            {
                $xparamArr = $xparam->toArray('xparam');
                $arr['xparam'][] = $xparamArr['xparam'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'at')
    {
        $name = !empty($name) ? $name : 'at';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_a))
        {
            $xml->addAttribute('a', $this->_a);
        }
        if(!empty($this->_url))
        {
            $xml->addAttribute('url', $this->_url);
        }
        if(!empty($this->_d))
        {
            $xml->addAttribute('d', $this->_d);
        }
        if(!empty($this->_sentBy))
        {
            $xml->addAttribute('sentBy', $this->_sentBy);
        }
        if(!empty($this->_dir))
        {
            $xml->addAttribute('dir', $this->_dir);
        }
        if(!empty($this->_lang))
        {
            $xml->addAttribute('lang', $this->_lang);
        }
        if(!empty($this->_cutype))
        {
            $xml->addAttribute('cutype', $this->_cutype);
        }
        if(!empty($this->_role))
        {
            $xml->addAttribute('role', $this->_role);
        }
        if($this->_ptst instanceof ParticipationStatus)
        {
            $xml->addAttribute('ptst', (string) $this->_ptst);
        }
        if(is_bool($this->_rsvp))
        {
            $xml->addAttribute('rsvp', $this->_rsvp ? 1 : 0);
        }
        if(!empty($this->_member))
        {
            $xml->addAttribute('member', $this->_member);
        }
        if(!empty($this->_delTo))
        {
            $xml->addAttribute('delTo', $this->_delTo);
        }
        if(!empty($this->_delFrom))
        {
            $xml->addAttribute('delFrom', $this->_delFrom);
        }
        foreach ($this->_xparam as $xparam)
        {
            $xml->append($xparam->toXml('xparam'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}