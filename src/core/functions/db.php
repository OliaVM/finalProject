<?php

function getDbConnection($dns, $user, $password)
{
	return new PDO($dns, $user, $password);
}
