import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';
import 'package:mymemberlink/views/login_screen.dart';

class SplashScreen extends StatefulWidget {
  const SplashScreen({super.key});

  @override
  State<SplashScreen> createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    Future.delayed(const Duration(seconds: 3), () {
      Navigator.push(context,
          MaterialPageRoute(builder: (context) => const LoginScreen()));
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: _buildUI(),
    );
  }

  Widget _buildUI() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Lottie.asset(
            "assets/animations/animation_1.json",
            fit: BoxFit.contain,
            width: 350,
            height: 350, // Set your desired width
            // Set your desired height
            repeat: false, // Stops the animation after it finishes once
            onLoaded: (composition) {
              Future.delayed(const Duration(milliseconds: 3500), () {
                setState(() {});
              });
            },
          ),
          // To add space between Lottie animation and text
          Text(
            "MyMemberLink",
            style: TextStyle(fontSize: 50, fontWeight: FontWeight.bold),
          ),
          SizedBox(height: 20),
        ],
      ),
    );
  }
}
