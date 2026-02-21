const W = 800;
const H = 500;

class Level1 extends Phaser.Scene {
  constructor() {
    super("Level1");
  }

  create() {
    this.goalTaken = false;
    this.winLayer = null;

    const ground = this.add.rectangle(W / 2, H - 20, W, 40, 0x2b395f);
    this.physics.add.existing(ground, true);

    const p1 = this.add.rectangle(220, 380, 200, 25, 0x2b395f);
    const p2 = this.add.rectangle(480, 300, 200, 25, 0x2b395f);
    const p3 = this.add.rectangle(680, 220, 180, 25, 0x2b395f);
    this.physics.add.existing(p1, true);
    this.physics.add.existing(p2, true);
    this.physics.add.existing(p3, true);

    this.player = this.add.rectangle(120, H - 120, 32, 32, 0xffffff);
    this.physics.add.existing(this.player);
    this.player.body.setCollideWorldBounds(true);

    this.physics.add.collider(this.player, ground);
    this.physics.add.collider(this.player, p1);
    this.physics.add.collider(this.player, p2);
    this.physics.add.collider(this.player, p3);

    const hazards = this.physics.add.staticGroup();

    const h1 = this.add.rectangle(330, H - 56, 90, 12, 0xff2d88);
    this.physics.add.existing(h1, true);
    hazards.add(h1);

    const h2 = this.add.rectangle(500, 270, 70, 12, 0xff2d88);
    this.physics.add.existing(h2, true);
    hazards.add(h2);

    this.goal = this.add.rectangle(700, 180, 18, 18, 0xffd34d);
    this.physics.add.existing(this.goal, true);

    this.exitZone = this.add.rectangle(760, 120, 70, 40, 0x20ff9a);
    this.exitZone.setAlpha(0.35);
    this.physics.add.existing(this.exitZone, true);

    this.physics.add.overlap(this.player, hazards, () => this.scene.restart());

    this.physics.add.overlap(this.player, this.goal, () => {
      if (this.goalTaken) return;
      this.goalTaken = true;
      this.goal.destroy();
      this.exitZone.setAlpha(0.9);
      this.hudMsg.setText("OBJETIVO CONSEGUIDO");
    });

    this.physics.add.overlap(this.player, this.exitZone, () => {
      if (!this.goalTaken) return;
      this.showWin();
    });

    this.cursors = this.input.keyboard.createCursorKeys();
    this.keyR = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.R);

    this.hudTop = this.add.text(18, 14, "NIVEL 1  |  OBJETIVO: NO", {
      fontFamily: "Arial",
      fontSize: "18px",
      color: "#e6f0ff",
    });

    this.hudMsg = this.add.text(18, 40, "", {
      fontFamily: "Arial",
      fontSize: "18px",
      color: "#ffd34d",
    });

    this.add.text(18, 66, "R reinicia", {
      fontFamily: "Arial",
      fontSize: "16px",
      color: "#9fb3ff",
    });
  }

  update() {
    if (Phaser.Input.Keyboard.JustDown(this.keyR)) {
      this.scene.restart();
      return;
    }

    this.hudTop.setText(
      `NIVEL 1  |  OBJETIVO: ${this.goalTaken ? "SÍ" : "NO"}`
    );

    if (this.winLayer) {
      if (Phaser.Input.Keyboard.JustDown(this.keyEnter)) {
        this.scene.start("Level2");
      }
      return;
    }

    if (this.cursors.left.isDown) this.player.body.setVelocityX(-220);
    else if (this.cursors.right.isDown) this.player.body.setVelocityX(220);
    else this.player.body.setVelocityX(0);

    const jump =
      Phaser.Input.Keyboard.JustDown(this.cursors.up) ||
      Phaser.Input.Keyboard.JustDown(this.cursors.space);

    if (jump && this.player.body.blocked.down)
      this.player.body.setVelocityY(-420);

    if (this.player.y > H + 80) this.scene.restart();
  }

  showWin() {
    if (this.winLayer) return;

    this.player.body.setVelocity(0, 0);
    this.player.body.moves = false;

    const bg = this.add
      .rectangle(W / 2, H / 2, 560, 250, 0x111a2e)
      .setAlpha(0.98);

    const t1 = this.add
      .text(W / 2, H / 2 - 70, "NIVEL 1 COMPLETADO", {
        fontFamily: "Arial",
        fontSize: "26px",
        color: "#20ff9a",
      })
      .setOrigin(0.5);

    const t2 = this.add
      .text(W / 2, H / 2 - 20, "Pulsa ENTER para ir al Nivel 2", {
        fontFamily: "Arial",
        fontSize: "18px",
        color: "#e6f0ff",
      })
      .setOrigin(0.5);

    const t3 = this.add
      .text(W / 2, H / 2 + 35, "Pulsa R para reiniciar", {
        fontFamily: "Arial",
        fontSize: "18px",
        color: "#9fb3ff",
      })
      .setOrigin(0.5);

    this.keyEnter = this.input.keyboard.addKey(
      Phaser.Input.Keyboard.KeyCodes.ENTER
    );

    this.winLayer = { bg, t1, t2, t3 };
  }
}

class Level2 extends Phaser.Scene {
  constructor() {
    super("Level2");
  }

  create() {
    this.goalTaken = false;
    this.switchOn = false;
    this.switchLock = false;
    this.winLayer = null;

    const ground = this.add.rectangle(W / 2, H - 20, W, 40, 0x2b395f);
    this.physics.add.existing(ground, true);

    const base1 = this.add.rectangle(160, 390, 170, 25, 0x2b395f);
    const base2 = this.add.rectangle(340, 330, 170, 25, 0x2b395f);
    this.physics.add.existing(base1, true);
    this.physics.add.existing(base2, true);

    this.bridgeA = this.add.rectangle(520, 280, 140, 20, 0x2b395f);
    this.physics.add.existing(this.bridgeA, true);

    this.bridgeB = this.add.rectangle(640, 230, 180, 20, 0x2b395f);
    this.physics.add.existing(this.bridgeB, true);

    this.bridgeB.body.enable = false;
    this.bridgeB.setAlpha(0.2);

    this.player = this.add.rectangle(90, H - 120, 32, 32, 0xffffff);
    this.physics.add.existing(this.player);
    this.player.body.setCollideWorldBounds(true);

    this.physics.add.collider(this.player, ground);
    this.physics.add.collider(this.player, base1);
    this.physics.add.collider(this.player, base2);
    this.physics.add.collider(this.player, this.bridgeA);
    this.physics.add.collider(this.player, this.bridgeB);

    this.switchObj = this.add.rectangle(340, 300, 22, 14, 0xff3b3b);
    this.physics.add.existing(this.switchObj, true);

    this.goal = this.add.rectangle(720, 190, 18, 18, 0xffd34d);
    this.physics.add.existing(this.goal, true);

    this.exitZone = this.add.rectangle(770, 120, 70, 40, 0x20ff9a);
    this.exitZone.setAlpha(0.25);
    this.physics.add.existing(this.exitZone, true);

    this.laser = this.physics.add.image(220, H - 70, "__laser__");
    this.laser.setVisible(false);

    const laserRect = this.add.rectangle(220, H - 70, 70, 10, 0xff2d88);
    this.laser.__rect = laserRect;

    this.laser.body.setAllowGravity(false);
    this.laser.body.setImmovable(true);
    this.laser.body.setSize(70, 10, true);
    this.laser.setVelocityX(160);
    this.laser.setBounce(1, 1);
    this.laser.setCollideWorldBounds(true);

    this.physics.add.overlap(this.player, this.laser, () =>
      this.scene.restart()
    );

    this.physics.add.overlap(this.player, this.switchObj, () => {
      if (this.switchLock) return;
      this.switchLock = true;
      this.time.delayedCall(250, () => (this.switchLock = false));
      this.toggleState();
    });

    this.physics.add.overlap(this.player, this.goal, () => {
      if (this.goalTaken) return;
      this.goalTaken = true;
      this.goal.destroy();
      this.hudMsg.setText("OBJETIVO CONSEGUIDO");
      this.updateExitVisual();
    });

    this.physics.add.overlap(this.player, this.exitZone, () => {
      if (!this.goalTaken) return;
      if (!this.switchOn) return;
      this.showWin();
    });

    this.cursors = this.input.keyboard.createCursorKeys();
    this.keyR = this.input.keyboard.addKey(Phaser.Input.Keyboard.KeyCodes.R);

    this.hudTop = this.add.text(18, 14, "", {
      fontFamily: "Arial",
      fontSize: "18px",
      color: "#e6f0ff",
    });

    this.hudMsg = this.add.text(
      18,
      40,
      "Activa el interruptor para cambiar el mapa",
      {
        fontFamily: "Arial",
        fontSize: "18px",
        color: "#ffd34d",
      }
    );

    this.add.text(18, 66, "R reinicia", {
      fontFamily: "Arial",
      fontSize: "16px",
      color: "#9fb3ff",
    });

    this.updateHud();
  }

  update() {
    if (Phaser.Input.Keyboard.JustDown(this.keyR)) {
      this.scene.restart();
      return;
    }

    if (this.laser && this.laser.__rect) {
      this.laser.__rect.x = this.laser.x;
      this.laser.__rect.y = this.laser.y;
    }

    this.updateHud();

    if (this.winLayer) {
      if (Phaser.Input.Keyboard.JustDown(this.keyEnter)) {
        this.scene.start("Level1");
      }
      return;
    }

    if (this.cursors.left.isDown) this.player.body.setVelocityX(-220);
    else if (this.cursors.right.isDown) this.player.body.setVelocityX(220);
    else this.player.body.setVelocityX(0);

    const jump =
      Phaser.Input.Keyboard.JustDown(this.cursors.up) ||
      Phaser.Input.Keyboard.JustDown(this.cursors.space);

    if (jump && this.player.body.blocked.down)
      this.player.body.setVelocityY(-420);

    if (this.player.y > H + 80) this.scene.restart();
  }

  toggleState() {
    this.switchOn = !this.switchOn;
    this.switchObj.fillColor = this.switchOn ? 0x20ff9a : 0xff3b3b;

    this.bridgeA.body.enable = !this.switchOn;
    this.bridgeA.setAlpha(this.switchOn ? 0.2 : 1);

    this.bridgeB.body.enable = this.switchOn;
    this.bridgeB.setAlpha(this.switchOn ? 1 : 0.2);

    this.updateExitVisual();
  }

  updateExitVisual() {
    const ok = this.goalTaken && this.switchOn;
    this.exitZone.setAlpha(ok ? 0.9 : 0.25);
  }

  updateHud() {
    this.hudTop.setText(
      `NIVEL 2  |  OBJETIVO: ${this.goalTaken ? "SÍ" : "NO"}  |  ESTADO: ${
        this.switchOn ? "ON" : "OFF"
      }`
    );
  }

  showWin() {
    if (this.winLayer) return;

    this.player.body.setVelocity(0, 0);
    this.player.body.moves = false;

    const bg = this.add
      .rectangle(W / 2, H / 2, 600, 260, 0x111a2e)
      .setAlpha(0.98);

    const t1 = this.add
      .text(W / 2, H / 2 - 75, "JUEGO COMPLETADO", {
        fontFamily: "Arial",
        fontSize: "28px",
        color: "#20ff9a",
      })
      .setOrigin(0.5);

    const t1b = this.add
      .text(W / 2, H / 2 - 35, "ENHORABUENA", {
        fontFamily: "Arial",
        fontSize: "24px",
        color: "#ffd34d",
      })
      .setOrigin(0.5);

    const t2 = this.add
      .text(W / 2, H / 2 + 5, "Has restaurado el sistema.", {
        fontFamily: "Arial",
        fontSize: "18px",
        color: "#e6f0ff",
      })
      .setOrigin(0.5);

    const t3 = this.add
      .text(W / 2, H / 2 + 45, "Pulsa ENTER para volver al Nivel 1", {
        fontFamily: "Arial",
        fontSize: "18px",
        color: "#e6f0ff",
      })
      .setOrigin(0.5);

    const t4 = this.add
      .text(W / 2, H / 2 + 85, "Pulsa R para reiniciar", {
        fontFamily: "Arial",
        fontSize: "18px",
        color: "#9fb3ff",
      })
      .setOrigin(0.5);

    this.keyEnter = this.input.keyboard.addKey(
      Phaser.Input.Keyboard.KeyCodes.ENTER
    );

    this.winLayer = { bg, t1, t1b, t2, t3, t4 };
  }
}

const config = {
  type: Phaser.AUTO,
  width: W,
  height: H,
  backgroundColor: "#0b0f1a",
  physics: {
    default: "arcade",
    arcade: { gravity: { y: 900 }, debug: false },
  },
  scene: [Level1, Level2],
};

new Phaser.Game(config);
