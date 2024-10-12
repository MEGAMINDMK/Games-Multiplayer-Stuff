<?php
class LUQuery {

	private $Socket = false;
	
	private $aData = array();

	private $servInfoReq = 0;
	private $playerInfoReq = 0;
	private $teamInfoReq = 0;
	private $playerInfoExtraReq = 0;

	public function __construct($Server, $Port = 2301)
	{
		$this->Defines();
		$this->Socket = fsockopen('udp://'.$Server, $Port, $Errno, $Errstr, 2);
		$this->aData[0] = true;
		if(!$this->Socket)
		{
			$this->aData[0] = false;
			return;
		}
		
		socket_set_timeout($this->Socket, 2);
		
		$packet = "\xFF\xFFUGP\x00";
		$packet .= "\x01";
		$packet .= ugp_header_ping;
		fwrite($this->Socket, $packet);
		if (fread($this->Socket, 2))
		{
			if (fread($this->Socket, 3) == "UGP")
			{
				$this->aData[0] = true;
				return;
			}
		}
		$this->aData[0] = false;
	}
	
	public function GetInfo()
	{
		// Request server info and player info
		$aData = array();
		$this->servInfoReq = ugp_servinf_name | ugp_servinf_mode | ugp_servinf_playercount | ugp_servinf_maxplayers;
		$this->playerInfoReq = ugp_playerlist_id | ugp_playerlist_name | ugp_playerlist_team | ugp_playerlist_score | ugp_playerlist_kills | ugp_playerlist_deaths | ugp_playerlist_extraflags;
		$this->playerInfoExtraReq = ugp_playerlist_extra_ping | ugp_playerlist_extra_pos | ugp_playerlist_extra_health | ugp_playerlist_extra_armour | ugp_playerlist_extra_skin;
		fwrite( $this->Socket, $this->createPacket( ugp_req_serverinfo | ugp_req_playerlist ) );
		fread($this->Socket, 10);
		$PacketType = ord(fread($this->Socket,1)) - 128;
		if ( $PacketType == 1 )
		{
			$GameID = ord(fread($this->Socket,1));
			$aData["GameID"] = $GameID;
			$Flags = ord( fread($this->Socket,1) );
			if ( $Flags & ugp_req_serverinfo )
			{
				$ServerInfoReply = ord( fread($this->Socket,1) );

				if ( $ServerInfoReply & ugp_servinf_gamename )
				{
					$GameNameLen = ord( fread($this->Socket,1) );
					$GameName = fread($this->Socket,$GameNameLen);
					$GameName = preg_replace('/[^(\x20-\x7F)]*/','', $GameName);
					$aData["GameName"] = $GameName;
				}
				if ( $ServerInfoReply & ugp_servinf_flags )
				{
					$ServerInfoReplyFlags = ord( fread($this->Socket,1) );
					$GameName = preg_replace('/[^(\x20-\x7F)]*/','', fread($this->Socket,$GameNameLen) );
					$aData["GameName"] = $GameName;
				}
				if ( $ServerInfoReply & ugp_servinf_name )
				{
					$ServerNameLen = ord( fread($this->Socket,1) );
					$ServerName = preg_replace('/[^(\x20-\x7F)]*/','', fread($this->Socket,$ServerNameLen) );
					$aData["ServerName"] = $ServerName;
				}
				if ( $ServerInfoReply & ugp_servinf_mode )
				{
					$ServerModeLen = ord( fread($this->Socket,1) );
					$ServerMode = preg_replace('/[^(\x20-\x7F)]*/','', fread($this->Socket,$ServerModeLen) );

					$aData["ServerMode"] = $ServerMode;
				}
				if ( $ServerInfoReply & ugp_servinf_map )
				{
					$ServerMapLen = ord( fread($this->Socket,1) );
					$ServerMap = preg_replace('/[^(\x20-\x7F)]*/','', fread($this->Socket,$ServerMapLen) );

					$aData["ServerMap"] = $ServerMap;
				}
				if ( $ServerInfoReply & ugp_servinf_playercount )
				{
					$ServerPlayers = ord( fread($this->Socket,1) );

					$aData["ServerPlayers"] = $ServerPlayers;
				}
				if ( $ServerInfoReply & ugp_servinf_maxplayers )
				{
					$ServerMaxPlayers = ord( fread($this->Socket,1) );

					$aData["ServerMaxPlayers"] = $ServerMaxPlayers;
				}
				
			}
			if ( $Flags & ugp_req_teamlist )
			{
				//echo fread($this->Socket,9000);
			}
			if ( $Flags & ugp_req_playerlist )
			{
				$Players = ord( fread($this->Socket, 1) );
				if ( $Players > 0 )
				{
					$PlayerReply = ord( fread($this->Socket,1) );
					if ( $PlayerReply & ugp_playerlist_extraflags )
					{
						$ExtraFlags = ord( fread($this->Socket,1) );
					}

					for($i = 1; $i <= $Players; $i++)
					{
						if ( isset( $ExtraFlags ) )
						{
							$aData["Player"][$i]["ExtraFlags"] = $ExtraFlags;
						}
						if ( $PlayerReply & ugp_playerlist_id )
						{
							$NickID = ord(fread($this->Socket,1));
							
							$aData["Player"][$i]["ID"] = $NickID;
						}
						if ( $PlayerReply & ugp_playerlist_name )
						{
							$NickLen = ord(fread($this->Socket,1));
							$Nick = preg_replace('/[^(\x20-\x7F)]*/','', fread($this->Socket,$NickLen) );
							
							$aData["Player"][$i]["Nick"] = $Nick;
						}
						if ( $PlayerReply & ugp_playerlist_team )
						{
							$Team = ord( fread($this->Socket,1) );
							
							$aData["Player"][$i]["Team"] = $Team;
						}
						if ( $PlayerReply & ugp_playerlist_score )
						{
							$Score = ord( fread($this->Socket,4) );
							
							$aData["Player"][$i]["Score"] = $Score;
						}
						if ( $PlayerReply & ugp_playerlist_kills )
						{
							$Kills = ord( fread($this->Socket,4) );
							
							$aData["Player"][$i]["Kills"] = $Kills;
						}
						if ( $PlayerReply & ugp_playerlist_deaths )
						{
							$Deaths = ord( fread($this->Socket,4) );
							
							$aData["Player"][$i]["Deaths"] = $Deaths;
						}
						if ( $PlayerReply & ugp_playerlist_extraflags )
						{
							if ( $ExtraFlags & ugp_playerlist_extra_ping )
							{
								$ping = ord( fread($this->Socket,2) );
								$aData["Player"][$i]["Ping"] = $ping;
							}
							if ( $ExtraFlags & ugp_playerlist_extra_timejoined )
							{
								$timejoined = ord( fread($this->Socket,8) );
								$aData["Player"][$i]["TimeJoined"] = $timejoined;
							}
							if ( $ExtraFlags & ugp_playerlist_extra_pos )
							{
								$posXArr = unpack( "f", fread($this->Socket,4) );
								$posYArr = unpack( "f", fread($this->Socket,4) );
								$posZArr = unpack( "f", fread($this->Socket,4) );
								$posX = $posXArr[1];
								$posY = $posYArr[1];
								$posZ = $posZArr[1];
								$aData["Player"][$i]["Pos"]["X"] = $posX;
								$aData["Player"][$i]["Pos"]["Y"] = $posY;
								$aData["Player"][$i]["Pos"]["Z"] = $posZ;
							}
							if ( $ExtraFlags & ugp_playerlist_extra_health )
							{
								$health = ord( fread($this->Socket,1) );
								$aData["Player"][$i]["Health"] = $health;
							}
							if ( $ExtraFlags & ugp_playerlist_extra_armour )
							{
								$armour = ord( fread($this->Socket,1) );
								$aData["Player"][$i]["Armour"] = $armour;
							}
							if ( $ExtraFlags & ugp_playerlist_extra_skin )
							{
								$skin = ord( fread($this->Socket,1) );
								$aData["Player"][$i]["Skin"] = $skin;
							}
							
						}
					}
				}
			}
		}
		
		return $aData;
	}
	private function createPacket($req)
	{
		$packet = "\xFF\xFFUGP\x00"; //Header
		$packet .= "\x01"; //Version
		$packet .= ugp_header_query; //Type, query or ping
		$packet .= chr($req);
		if ( $req & ugp_req_serverinfo )
		{
			$packet .= chr($this->servInfoReq);
		}
		if ( $req & ugp_req_teamlist )
		{
			$packet .= chr($this->teamInfoReq);
		}
		if ( $req & ugp_req_playerlist )
		{
			$packet .= chr($this->playerInfoReq);

			if ( $this->playerInfoReq & ugp_playerlist_extraflags )
			{
				$packet .= chr($this->playerInfoExtraReq);
			}
		}
		if ( $req & ugp_req_rulelist )
		{
			$packet .= chr(ugp_req_rulelist);
		}
		return $packet;
	}
	
	public function IsAlive()
	{
		return $this->aData[0];
	}
	
	private function Defines()
{
    // Header Flags
    if (!defined("ugp_header_ping")) define("ugp_header_ping", "\x00");
    if (!defined("ugp_header_query")) define("ugp_header_query", "\x01");

    // Request Flags
    if (!defined("ugp_req_serverinfo")) define("ugp_req_serverinfo", 0x01);
    if (!defined("ugp_req_playerlist")) define("ugp_req_playerlist", 0x02);
    if (!defined("ugp_req_teamlist")) define("ugp_req_teamlist", 0x04);
    if (!defined("ugp_req_rulelist")) define("ugp_req_rulelist", 0x08);

    // Server Info Flags
    if (!defined("ugp_servinf_gamename")) define("ugp_servinf_gamename", 0x01);
    if (!defined("ugp_servinf_flags")) define("ugp_servinf_flags", 0x02);
    if (!defined("ugp_servinf_name")) define("ugp_servinf_name", 0x04);
    if (!defined("ugp_servinf_mode")) define("ugp_servinf_mode", 0x08);
    if (!defined("ugp_servinf_map")) define("ugp_servinf_map", 0x10);
    if (!defined("ugp_servinf_playercount")) define("ugp_servinf_playercount", 0x20);
    if (!defined("ugp_servinf_maxplayers")) define("ugp_servinf_maxplayers", 0x40);

    // Server Info Server Flags (Bit 2 in info flags)
    if (!defined("ugp_servinfflags_passworded")) define("ugp_servinfflags_passworded", 0x01);
    if (!defined("ugp_servinfflags_version")) define("ugp_servinfflags_version", 0x02);
    if (!defined("ugp_servinfflags_os")) define("ugp_servinfflags_os", 0x04);

    // Team List Flags
    if (!defined("ugp_teamlist_name")) define("ugp_teamlist_name", 0x01);
    if (!defined("ugp_teamlist_score")) define("ugp_teamlist_score", 0x02);
    if (!defined("ugp_teamlist_playercount")) define("ugp_teamlist_playercount", 0x04);
    if (!defined("ugp_teamlist_colour")) define("ugp_teamlist_colour", 0x08);

    // Player List Flags
    if (!defined("ugp_playerlist_id")) define("ugp_playerlist_id", 0x01);
    if (!defined("ugp_playerlist_name")) define("ugp_playerlist_name", 0x02);
    if (!defined("ugp_playerlist_team")) define("ugp_playerlist_team", 0x04);
    if (!defined("ugp_playerlist_score")) define("ugp_playerlist_score", 0x08);
    if (!defined("ugp_playerlist_kills")) define("ugp_playerlist_kills", 0x10);
    if (!defined("ugp_playerlist_deaths")) define("ugp_playerlist_deaths", 0x20);
    if (!defined("ugp_playerlist_extraflags")) define("ugp_playerlist_extraflags", 0x40);

    // Player List Extra Flags
    if (!defined("ugp_playerlist_extra_ping")) define("ugp_playerlist_extra_ping", 0x01);
    if (!defined("ugp_playerlist_extra_timejoined")) define("ugp_playerlist_extra_timejoined", 0x02);
    if (!defined("ugp_playerlist_extra_pos")) define("ugp_playerlist_extra_pos", 0x04);
    if (!defined("ugp_playerlist_extra_health")) define("ugp_playerlist_extra_health", 0x08);
    if (!defined("ugp_playerlist_extra_armour")) define("ugp_playerlist_extra_armour", 0x10);
    if (!defined("ugp_playerlist_extra_skin")) define("ugp_playerlist_extra_skin", 0x20);
}

}
?>