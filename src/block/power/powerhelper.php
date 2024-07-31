<?php

/*
 * Copyright (c) 2024 - present nicholass003
 *        _      _           _                ___   ___ ____
 *       (_)    | |         | |              / _ \ / _ \___ \
 *  _ __  _  ___| |__   ___ | | __ _ ___ ___| | | | | | |__) |
 * | '_ \| |/ __| '_ \ / _ \| |/ _` / __/ __| | | | | | |__ <
 * | | | | | (__| | | | (_) | | (_| \__ \__ \ |_| | |_| |__) |
 * |_| |_|_|\___|_| |_|\___/|_|\__,_|___/___/\___/ \___/____/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author  nicholass003
 * @link    https://github.com/nicholass003/
 *
 *
 */

declare(strict_types=1);

namespace nicholass003\redstonemechanics\block\power;

use nicholass003\redstonemechanics\block\IBlockRedstoneHelper;
use nicholass003\redstonemechanics\RedstoneMechanics;
use pocketmine\block\Block;
use pocketmine\block\Lever;
use pocketmine\math\Facing;

class BlockRedstonePowerHelper implements IBlockRedstoneHelper{

	public static function update(Block $block) : array{
		$affectedBlocks = [];
		if($block instanceof Lever){
			foreach(Facing::ALL as $face){
				if($face === $block->getFacing()->getFacing()){
					continue;
				}
				$rBlock = $block->getSide($face);
				if(RedstoneMechanics::isPoweredByRedstone($rBlock)){
					$rBlock->setPowered($block->isActivated());
					$rBlock->getPosition()->getWorld()->setBlock($rBlock->getPosition(), $rBlock);
					$affectedBlocks[] = $rBlock;
				}
			}
		}
		return $affectedBlocks;
	}
}