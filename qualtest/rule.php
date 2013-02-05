<!DOCTYPE HTML>
<html>
<?php include_once("head.php"); ?>

<body>
  <div id="main">
    <?php include_once("header.php"); ?>

    <div id="site_content">
      <div id="sidebar_container">
        <?php include_once("notice.php"); ?>
        <?php include_once("rank.php"); ?>
      </div>

      <div class="content">
        <div class="probdiv">
					<h1>Rules To Know</h1>
					<hr>
					<br>
            <h3>일반 룰:</h3>
            <br>
            <ol>
              <li>개인전으로 제한한다.</li>
							<li>가입시 학번은 반드시 자신의 학번을 입력한다.</li>
              <li>대회 종료 이후에 풀이는 평가에 반영되지 않는다. (점수에는 들어감)</li>
              <li>대회 ID는 반드시 1인 1개로 제한한다. 후에 중복아이디는 무단 삭제될 수 있다.</li>
              <li>IP는 학교 내부 IP로 제한한다.</li>
              <li>서로 다른 사람과 연합하여 대회에 참가하는 것은 인정하지 않는다.</li>
              <li>대회 신청을 하지 않은 사람은 대회에 참가할 수 없다.</li>
              <li>대회 문제 출제자 및 문제에 대한 아이디어 제공자, 대회 관계자가 아닌 경우에만 참가가 가능하다.</li>
              <li>대회 문제 출제자 및 대회 관계자들은 참가자들과 공식적인 힌트 외의 문제 풀이법에 대한 대화를 가질 수 없다.</li>
              <li>대회 문제에 대한 힌트나 질문은 준비하지 않으나 문제 난이도나 상황에 따라 이벤트성 힌트가 제공될 수 있다.</li>
              <li>정당한 공격 방법이 아닌 대회 서버 접근, 주최측 운영 실수로 인한 권한 상승 및 키 값 획득은 무효 처리한다.</li>
              <li>대회 게임 서버 외의 다른 서버에 대한 침투나 공격을 시도하여 대회 운영을 방해할 경우 실격될 수 있다.</li>
              <li>대회 운영을 방해하는 네트워크 공격, 시스템 조작을 금지하나 게입 서버를 해킹할 수 있는 버그 발견 시 추가 점수 부여한다.</li>
            </ol>

            <hr>
            <br>
            <h4>스페셜 룰:</h4>
            <br>
            <ol>
              <li>참가자간의 힌트 및 문제 풀이, 답안 공유 금지한다. 해당 사항을 지키지 않을 경우 실격될 수 있다.</li>
              <li>문제별 점수는 대회 문제 출제자들의 합의하에 결정된다.</li>
              <li>점수가 동점일 경우에는 해당 점수에 먼저 획득한 사람이 상위로 랭크된다.</li>
              <h5>문제별 BreakThrough를 두어 이를 보완하도록 한다.</h5>
              <li>고의적인 다중 계정 등록 및 반복적인 답안 등록은 주최측이 임의적으로 제제 조치를 취할 수 있다.</li>
              <li>주최측은 실시간으로 변동되는 참가자의 점수 집계 결과 및 합산 순위를 실시간으로 알 수 있다.</li>
              <li>푼 문제 개수와 관계없이 점수 합산 결과, 고득점자 상위 3명에게 상품을 수여한다!?</li>
            </ol>

            <hr>
            <br>
            <h3>General Rules:</h3>
            <br>
            <ol>
              <li>Limit this qual for private exhibition.</li>
							<li>You have to join with your own student ID</li>
              <li>Solutions over deadline are not considered.</li>
              <li>Each one has to use only one ID. Otherwise you might have some kind of disadvantage.</li>
              <li>Each one should use KAIST IP.</li>
              <li>Participants must not co-operate with each other.</li>
              <li>You can't participate in the qual if you didn't sign up.</li>
              <li>Only the person who are not related to the qual can participate in.</li>
              <li>Organizers must not say any word to participants unless it's official hint.</li>
              <li>Organizers can give official hints if some problems are tooooo difficult.</li>
              <li>Any illegal access is punished.</li>
              <li>If you find some bugs that can hack servers, you are deserved to get bonus points.</li>
            </ol>

            <hr>
            <br>
            <h4>Special Rules:</h4>
            <br>
            <ol>
              <li>Each one can’t share any hints or solutions. if you can be disqualified for violating this. </li>
              <li>The point calculation for each problem and whole point system will be as following rules. </li>
              <li>Each problem has its original points depending on its difficulty.</li>
              <li>When the points are tied, the one who gets the point faster will be ranked higher. </li>
              <h5>We have breakthrough to reinforce this rule.</h5>
              <li>Intentional registration of multiple IDs and repeated attempt to submitting wrong answers can be punished.</li>
              <li>Organizing committee can know the point and status of each participant real-time. </li>
              <li>Regardless of the number of problem solved, top 3 people with highest points will get awards.</li>
            </ol>



        </div>
      </div>
    </div>

    <?php include_once("footer.php"); ?>
  </div>
</body>
</html>
