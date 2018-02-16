<?php
// Добавление даты публикации
				function GetFullNowDateInCity($timezoneInCity){
					$FullNowDateInCity = date('d.m.Y H:i', (time()+$timezoneInCity*60*60));
					return $FullNowDateInCity;
				}
				
